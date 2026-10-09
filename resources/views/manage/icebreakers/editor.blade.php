@php
    $isEditing = !empty($deck);
    $pageLabel = $isEditing ? __tr('Edit Deck') : __tr('New Deck');
@endphp
@section('page-title', $pageLabel)
@section('head-title', $pageLabel)
@section('keywordName', strip_tags($pageLabel))
@section('keyword', strip_tags($pageLabel))
@section('description', strip_tags($pageLabel))
@section('keywordDescription', strip_tags($pageLabel))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <a href="<?= route('manage.icebreakers.decks.index') ?>" class="text-gray-400" style="text-decoration: none; font-size: 13px;">
            <i class="fas fa-arrow-left mr-1"></i> <?= __tr("Back to decks") ?>
        </a>
        <h1 class="h3 mb-0 text-gray-200 mt-1">
            {{ $isEditing ? $deck->name : __tr('New Deck') }}
        </h1>
    </div>
    @if($isEditing && $deck->isPublished())
        <a href="{{ url('/icebreakers/' . $deck->slug) }}" target="_blank" class="btn btn-sm shadow-sm" style="background: white; color: #6b3fd6; border: 1px solid #efe8ff; border-radius: 999px; padding: 6px 16px; font-weight: 600;">
            <i class="fas fa-external-link-alt fa-sm mr-1"></i> <?= __tr("View live") ?>
        </a>
    @endif
</div>

@if(session('success'))
    <div class="alert alert-success" style="border-radius: 12px;">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger" style="border-radius: 12px;">{{ session('error') }}</div>
@endif
@if(isset($errors) && $errors->any())
    <div class="alert alert-danger" style="border-radius: 12px;">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="row">
    {{-- ============================================================ --}}
    {{-- LEFT: Deck settings form                                     --}}
    {{-- ============================================================ --}}
    <div class="col-lg-5 mb-4">
        <div class="card shadow" style="border-radius: 16px; border: 0; background: #ffffff;">
            <div class="card-body p-4">
                <h5 class="mb-3" style="color: #1a0e34; font-weight: 700;"><?= __tr("Deck details") ?></h5>

                <form
                    action="{{ $isEditing ? route('manage.icebreakers.decks.update', ['deck' => $deck->_uid]) : route('manage.icebreakers.decks.store') }}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @if($isEditing) @method('PUT') @endif

                    <div class="form-group">
                        <label class="text-gray-700" style="font-weight: 600; font-size: 13px;"><?= __tr("Name") ?></label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', $isEditing ? $deck->name : '') }}"
                               placeholder="First Date" required maxlength="100" style="border-radius: 8px;">
                    </div>

                    <div class="form-group">
                        <label class="text-gray-700" style="font-weight: 600; font-size: 13px;"><?= __tr("Caption") ?> <span class="text-muted" style="font-weight: 400;">(shown under deck name in grid)</span></label>
                        <input type="text" name="caption" class="form-control"
                               value="{{ old('caption', $isEditing ? $deck->caption : '') }}"
                               placeholder="Skip the small talk." maxlength="200" style="border-radius: 8px;">
                    </div>

                    <div class="form-group">
                        <label class="text-gray-700" style="font-weight: 600; font-size: 13px;"><?= __tr("Description") ?> <span class="text-muted" style="font-weight: 400;">(longer intro on the deck page)</span></label>
                        <textarea name="description" class="form-control" rows="3" style="border-radius: 8px;">{{ old('description', $isEditing ? $deck->description : '') }}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-gray-700" style="font-weight: 600; font-size: 13px;"><?= __tr("Category") ?></label>
                            <input type="text" name="category" class="form-control"
                                   list="ibCategorySuggestions"
                                   value="{{ old('category', $isEditing ? $deck->category : '') }}"
                                   placeholder="e.g. dating, couples, friends — or type a new one"
                                   required maxlength="50"
                                   style="border-radius: 8px;">
                            <datalist id="ibCategorySuggestions">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat['id'] }}">{{ $cat['label'] }}</option>
                                @endforeach
                            </datalist>
                            <small class="text-muted" style="font-size: 11px;">
                                <?= __tr("Pick an existing category or type a new one — appears automatically on the public filter.") ?>
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-gray-700" style="font-weight: 600; font-size: 13px;"><?= __tr("Cover style") ?></label>
                            <select name="variant" class="form-control" required style="border-radius: 8px;">
                                @foreach($variants as $v)
                                    <option value="{{ $v['id'] }}" @selected(old('variant', $isEditing ? $deck->variant : 'solid') === $v['id'])>
                                        {{ $v['label'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-gray-700" style="font-weight: 600; font-size: 13px;"><?= __tr("Slug") ?> <span class="text-muted" style="font-weight: 400;">(URL — auto if blank)</span></label>
                            <input type="text" name="slug" class="form-control"
                                   value="{{ old('slug', $isEditing ? $deck->slug : '') }}"
                                   placeholder="first-date" maxlength="120" style="border-radius: 8px;">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-gray-700" style="font-weight: 600; font-size: 13px;"><?= __tr("Vibe label") ?></label>
                            <input type="text" name="vibe_label" class="form-control"
                                   value="{{ old('vibe_label', $isEditing ? $deck->vibe_label : '') }}"
                                   placeholder="Playful" maxlength="40" style="border-radius: 8px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-gray-700" style="font-weight: 600; font-size: 13px;"><?= __tr("Cover image") ?> <span class="text-muted" style="font-weight: 400;">(optional — JPG/PNG/WebP, max 4MB)</span></label>
                        <input type="file" name="cover_image" class="form-control-file" accept="image/*">
                        @if($isEditing && !empty($deck->cover_image))
                            <div class="mt-2" style="font-size: 12px; color: #6b3fd6;">
                                <i class="fas fa-check mr-1"></i> {{ __tr('Current image will be replaced if you upload a new one.') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="statusToggle" name="status" value="1"
                                   {{ old('status', $isEditing && $deck->isPublished() ? 1 : 0) ? 'checked' : '' }}>
                            <label class="custom-control-label text-gray-700" for="statusToggle" style="font-weight: 600;">
                                <?= __tr("Published") ?> <span class="text-muted" style="font-weight: 400; font-size: 12px;">(visible on /icebreakers)</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn shadow-sm" style="background: #6b3fd6; color: white; border-radius: 999px; padding: 10px 24px; font-weight: 600; width: 100%;">
                        <i class="fas fa-save mr-1"></i>
                        {{ $isEditing ? __tr('Save deck') : __tr('Create deck') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- RIGHT: Question manager                                      --}}
    {{-- Only shown after the deck exists (needs a deck_id to POST to)--}}
    {{-- ============================================================ --}}
    <div class="col-lg-7 mb-4">
        @if(!$isEditing)
            <div class="card shadow" style="border-radius: 16px; border: 0; background: #f8f5fb;">
                <div class="card-body p-4 text-center">
                    <div style="font-size: 36px; color: #b6a8d4; margin-bottom: 8px;">
                        <i class="fas fa-arrow-left"></i>
                    </div>
                    <p class="mb-0" style="color: #4a3b6a;">
                        <?= __tr("Save the deck first — then you can add questions to it.") ?>
                    </p>
                </div>
            </div>
        @else
            <div class="card shadow mb-3" style="border-radius: 16px; border: 0; background: #ffffff;">
                <div class="card-body p-4">
                    <h5 class="mb-3" style="color: #1a0e34; font-weight: 700;">
                        <?= __tr("Questions") ?>
                        <span class="text-muted" style="font-weight: 400; font-size: 14px;">({{ $deck->questions->count() }})</span>
                    </h5>

                    {{-- Add-a-question inline input --}}
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="ibQuestionInput" class="form-control"
                                   placeholder="{{ __tr('Type a question and press Enter…') }}"
                                   style="border-radius: 8px 0 0 8px;">
                            <input type="text" id="ibCategoryInput" class="form-control"
                                   placeholder="{{ __tr('Tag (optional)') }}"
                                   maxlength="40" style="max-width: 140px; border-left: 0;">
                            <div class="input-group-append">
                                <button type="button" id="ibAddQuestionBtn" class="btn" style="background: #6b3fd6; color: white; border-radius: 0 8px 8px 0; padding: 8px 20px; font-weight: 600;">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div id="ibQuestionInputError" class="mt-1" style="color: #e91e63; font-size: 12px; display: none;"></div>
                    </div>

                    {{-- Existing questions list --}}
                    <ul id="ibQuestionsList" class="list-unstyled mb-0" data-deck-uid="{{ $deck->_uid }}">
                        @foreach($deck->questions as $q)
                            <li class="ib-question-row" data-question-id="{{ $q->_id }}" data-question-uid="{{ $q->_uid }}"
                                style="display: flex; align-items: center; gap: 10px; padding: 10px 12px; background: #f8f5fb; border-radius: 10px; margin-bottom: 8px;">
                                <span class="ib-drag-handle" style="cursor: grab; color: #b6a8d4;" title="{{ __tr('Drag to reorder') }}">
                                    <i class="fas fa-grip-vertical"></i>
                                </span>
                                <span class="ib-question-text" style="flex: 1; color: #1a0e34; font-size: 14px; line-height: 1.4;">
                                    {{ $q->question_text }}
                                </span>
                                @if($q->category_tag)
                                    <span class="ib-question-tag" style="font-size: 10px; font-weight: 800; letter-spacing: 1px; padding: 3px 8px; border-radius: 999px; background: #ffe0ea; color: #e63566;">
                                        {{ $q->category_tag }}
                                    </span>
                                @endif
                                <button type="button" class="ib-delete-btn btn btn-sm" style="background: none; color: #b6a8d4; padding: 4px 8px; border-radius: 6px;" title="{{ __tr('Delete') }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    @if($deck->questions->isEmpty())
                        <p class="text-muted text-center py-3 mb-0" style="font-size: 13px;">
                            <?= __tr("No questions yet. Add one above or bulk-paste below.") ?>
                        </p>
                    @endif
                </div>
            </div>

            {{-- Bulk paste importer --}}
            <div class="card shadow" style="border-radius: 16px; border: 0; background: #ffffff;">
                <div class="card-body p-4">
                    <h5 class="mb-2" style="color: #1a0e34; font-weight: 700;">
                        <i class="fas fa-paste mr-1" style="color: #6b3fd6;"></i>
                        <?= __tr("Bulk import") ?>
                    </h5>
                    <p class="text-muted" style="font-size: 13px; margin-bottom: 12px;">
                        <?= __tr("Paste one question per line. Duplicates are skipped.") ?>
                    </p>

                    <form action="{{ route('manage.icebreakers.questions.bulk', ['deck' => $deck->_uid]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="raw_text" class="form-control" rows="5"
                                      placeholder="{{ __tr('What made you laugh today?\nWhat did you last daydream about?\nWhat\'s something you\'ve changed your mind about?') }}"
                                      style="border-radius: 8px; font-family: monospace; font-size: 13px;" required></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <input type="text" name="category_tag" class="form-control"
                                       placeholder="{{ __tr('Optional tag for all imported questions') }}"
                                       maxlength="40" style="border-radius: 8px;">
                            </div>
                            <div class="form-group col-md-4">
                                <button type="submit" class="btn btn-block" style="background: #6b3fd6; color: white; border-radius: 8px; font-weight: 600;">
                                    <?= __tr("Import") ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

@if($isEditing)
{{-- ============================================================
     Admin question manager JS
     - Add on Enter or click +
     - Inline edit on text click
     - Delete with confirmation
     - Drag-drop reorder using SortableJS from cdnjs (CSP-allowed)
     ============================================================ --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
<script>
(function() {
    const deckUid = "{{ $deck->_uid }}";
    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
              || document.querySelector('input[name="_token"]')?.value;

    const list        = document.getElementById('ibQuestionsList');
    const qInput      = document.getElementById('ibQuestionInput');
    const catInput    = document.getElementById('ibCategoryInput');
    const addBtn      = document.getElementById('ibAddQuestionBtn');
    const errorEl     = document.getElementById('ibQuestionInputError');

    if (!list) return;

    /* URL builders (route names → URLs baked at render time) */
    const urls = {
        store:   "{{ route('manage.icebreakers.questions.store', ['deck' => $deck->_uid]) }}",
        update:  "{{ route('manage.icebreakers.questions.update', ['question' => 'QID']) }}",
        destroy: "{{ route('manage.icebreakers.questions.destroy', ['question' => 'QID']) }}",
        reorder: "{{ route('manage.icebreakers.questions.reorder', ['deck' => $deck->_uid]) }}",
    };

    function showError(msg) {
        errorEl.textContent = msg;
        errorEl.style.display = 'block';
    }
    function clearError() {
        errorEl.textContent = '';
        errorEl.style.display = 'none';
    }

    async function apiPost(url, body, method = 'POST') {
        const isForm = body instanceof FormData;
        const headers = { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf };
        if (!isForm) headers['Content-Type'] = 'application/json';
        if (method !== 'POST') headers['X-HTTP-Method-Override'] = method;

        const res = await fetch(url, {
            method: 'POST', // Laravel picks up X-HTTP-Method-Override
            headers,
            body: isForm ? body : JSON.stringify(body),
        });
        const data = await res.json().catch(() => ({}));
        return { ok: res.ok && data.success !== false, data };
    }

    function makeRow(q) {
        const li = document.createElement('li');
        li.className = 'ib-question-row';
        li.dataset.questionId = q._id;
        li.dataset.questionUid = q._uid;
        li.style.cssText = 'display:flex; align-items:center; gap:10px; padding:10px 12px; background:#f8f5fb; border-radius:10px; margin-bottom:8px;';
        li.innerHTML = `
            <span class="ib-drag-handle" style="cursor:grab; color:#b6a8d4;" title="Drag to reorder"><i class="fas fa-grip-vertical"></i></span>
            <span class="ib-question-text" style="flex:1; color:#1a0e34; font-size:14px; line-height:1.4;"></span>
            ${q.category_tag ? `<span class="ib-question-tag" style="font-size:10px; font-weight:800; letter-spacing:1px; padding:3px 8px; border-radius:999px; background:#ffe0ea; color:#e63566;"></span>` : ''}
            <button type="button" class="ib-delete-btn btn btn-sm" style="background:none; color:#b6a8d4; padding:4px 8px; border-radius:6px;" title="Delete"><i class="fas fa-trash"></i></button>
        `;
        li.querySelector('.ib-question-text').textContent = q.question_text;
        if (q.category_tag) li.querySelector('.ib-question-tag').textContent = q.category_tag;
        wireRow(li);
        return li;
    }

    function wireRow(li) {
        // Delete
        li.querySelector('.ib-delete-btn').addEventListener('click', async () => {
            if (!confirm('Delete this question?')) return;
            const uid = li.dataset.questionUid;
            const { ok } = await apiPost(urls.destroy.replace('QID', uid), {}, 'DELETE');
            if (ok) li.remove();
            else alert('Failed to delete.');
        });

        // Inline edit on text click
        const textEl = li.querySelector('.ib-question-text');
        textEl.addEventListener('click', () => beginEdit(li, textEl));
    }

    function beginEdit(li, textEl) {
        if (li.classList.contains('is-editing')) return;
        li.classList.add('is-editing');
        const original = textEl.textContent;
        const input = document.createElement('input');
        input.type = 'text';
        input.value = original;
        input.className = 'form-control';
        input.style.cssText = 'font-size:14px; padding:6px 10px; border-radius:6px;';
        textEl.replaceWith(input);
        input.focus();
        input.select();

        function commit() {
            const newText = input.value.trim();
            if (!newText || newText === original) return revert();
            saveEdit(li, newText, original);
        }
        function revert() {
            const span = document.createElement('span');
            span.className = 'ib-question-text';
            span.style.cssText = 'flex:1; color:#1a0e34; font-size:14px; line-height:1.4;';
            span.textContent = original;
            span.addEventListener('click', () => beginEdit(li, span));
            input.replaceWith(span);
            li.classList.remove('is-editing');
        }
        input.addEventListener('blur', commit);
        input.addEventListener('keydown', e => {
            if (e.key === 'Enter') { e.preventDefault(); input.blur(); }
            if (e.key === 'Escape') { input.value = original; input.blur(); }
        });
    }

    async function saveEdit(li, newText, original) {
        const uid = li.dataset.questionUid;
        const { ok, data } = await apiPost(urls.update.replace('QID', uid), { question_text: newText }, 'PUT');
        const finalText = ok ? newText : original;
        const span = document.createElement('span');
        span.className = 'ib-question-text';
        span.style.cssText = 'flex:1; color:#1a0e34; font-size:14px; line-height:1.4;';
        span.textContent = finalText;
        span.addEventListener('click', () => beginEdit(li, span));
        li.querySelector('input.form-control').replaceWith(span);
        li.classList.remove('is-editing');
        if (!ok) alert(data.message || 'Failed to update.');
    }

    async function addQuestion() {
        clearError();
        const text = (qInput.value || '').trim();
        const tag  = (catInput.value || '').trim();
        if (text.length < 3) return showError('Question needs at least 3 characters.');

        addBtn.disabled = true;
        const { ok, data } = await apiPost(urls.store, {
            question_text: text,
            category_tag: tag || null,
            status: 1,
        });
        addBtn.disabled = false;

        if (ok && data.data && data.data.question) {
            list.appendChild(makeRow(data.data.question));
            qInput.value = '';
            catInput.value = '';
            qInput.focus();
        } else {
            showError(data.message || 'Failed to add.');
        }
    }

    addBtn.addEventListener('click', addQuestion);
    qInput.addEventListener('keydown', e => {
        if (e.key === 'Enter') { e.preventDefault(); addQuestion(); }
    });

    // Wire existing rows
    list.querySelectorAll('.ib-question-row').forEach(wireRow);

    // Drag-drop reorder
    if (window.Sortable) {
        Sortable.create(list, {
            handle: '.ib-drag-handle',
            animation: 150,
            ghostClass: 'ib-drag-ghost',
            onEnd: async () => {
                const ids = Array.from(list.querySelectorAll('.ib-question-row'))
                    .map(li => parseInt(li.dataset.questionId, 10))
                    .filter(Boolean);
                await apiPost(urls.reorder, { ordered_ids: ids });
            },
        });
    }
})();
</script>
<style>
    .ib-drag-ghost { opacity: 0.4; background: #efe8ff !important; }
    .ib-question-text { cursor: text; }
    .ib-question-text:hover { background: rgba(107, 63, 214, 0.05); border-radius: 4px; padding: 2px 4px; margin: -2px -4px; }
</style>
@endif
