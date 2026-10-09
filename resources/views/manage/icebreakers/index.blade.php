@section('page-title', __tr("Icebreaker Decks"))
@section('head-title', __tr("Icebreaker Decks"))
@section('keywordName', strip_tags(__tr("Icebreaker Decks")))
@section('keyword', strip_tags(__tr("Icebreaker Decks")))
@section('description', strip_tags(__tr("Manage LoversNmore Icebreaker decks")))
@section('keywordDescription', strip_tags(__tr("Manage LoversNmore Icebreaker decks")))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-200">
            <i class="fas fa-layer-group mr-2" style="color: #ff4778;"></i>
            <?= __tr("Icebreaker Decks") ?>
        </h1>
        <p class="text-gray-400 mb-0 mt-1" style="font-size: 13px;">
            <?= __tr("Manage conversation decks and questions shown at /icebreakers.") ?>
        </p>
    </div>
    <a href="<?= route('manage.icebreakers.decks.create') ?>" class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background:#6b3fd6; color:white; border-radius: 999px; padding: 8px 20px; font-weight: 600;">
        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> <?= __tr("New Deck") ?>
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success" style="border-radius: 12px;">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger" style="border-radius: 12px;">{{ session('error') }}</div>
@endif

<div class="card shadow" style="border-radius: 16px; border: 0; background: #ffffff;">
    <div class="card-body p-0">
        @if($decks->isEmpty())
            <div class="text-center py-5">
                <div style="font-size: 44px; color: #b6a8d4; margin-bottom: 12px;">
                    <i class="fas fa-layer-group"></i>
                </div>
                <p class="text-gray-500 mb-3"><?= __tr("No decks yet. Create your first deck to get started.") ?></p>
                <a href="<?= route('manage.icebreakers.decks.create') ?>" class="btn btn-sm" style="background:#6b3fd6; color:white; border-radius: 999px; padding: 8px 20px; font-weight: 600;">
                    <?= __tr("Create Deck") ?>
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="font-size: 14px;">
                    <thead style="background: #f8f5fb;">
                        <tr>
                            <th style="border: 0; padding: 14px 20px; background: #f8f5fb; color: #4a3b6a; font-weight: 700; font-size: 12px; letter-spacing: 0.3px; text-transform: uppercase;"><?= __tr("Deck") ?></th>
                            <th style="border: 0; padding: 14px 20px; background: #f8f5fb; color: #4a3b6a; font-weight: 700; font-size: 12px; letter-spacing: 0.3px; text-transform: uppercase;"><?= __tr("Category") ?></th>
                            <th style="border: 0; padding: 14px 20px; background: #f8f5fb; color: #4a3b6a; font-weight: 700; font-size: 12px; letter-spacing: 0.3px; text-transform: uppercase;"><?= __tr("Style") ?></th>
                            <th style="border: 0; padding: 14px 20px; background: #f8f5fb; color: #4a3b6a; font-weight: 700; font-size: 12px; letter-spacing: 0.3px; text-transform: uppercase; text-align: center;"><?= __tr("Questions") ?></th>
                            <th style="border: 0; padding: 14px 20px; background: #f8f5fb; color: #4a3b6a; font-weight: 700; font-size: 12px; letter-spacing: 0.3px; text-transform: uppercase;"><?= __tr("Status") ?></th>
                            <th style="border: 0; padding: 14px 20px; background: #f8f5fb; color: #4a3b6a; font-weight: 700; font-size: 12px; letter-spacing: 0.3px; text-transform: uppercase; text-align: right;"><?= __tr("Actions") ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($decks as $deck)
                            <tr>
                                <td style="padding: 14px 20px; vertical-align: middle;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 36px; height: 46px; border-radius: 6px; display: grid; place-items: center; box-shadow: 0 2px 8px rgba(74,30,170,0.15); background: {{ $deck->variant === 'solid' ? 'linear-gradient(160deg, #7a49e6 0%, #5928c4 100%)' : 'linear-gradient(160deg, #e2d3f7 0%, #d1bef0 100%)' }};">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="{{ $deck->variant === 'solid' ? 'white' : '#3d1e91' }}"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                        </div>
                                        <div>
                                            <div style="font-weight: 700; color: #1a0e34;">{{ $deck->name }}</div>
                                            <div style="font-size: 12px; color: #8b849e;">/icebreakers/{{ $deck->slug }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 14px 20px; vertical-align: middle;">
                                    <span style="text-transform: capitalize; color: #4a3b6a;">{{ $deck->category }}</span>
                                </td>
                                <td style="padding: 14px 20px; vertical-align: middle;">
                                    <span style="text-transform: capitalize; color: #4a3b6a;">{{ $deck->variant }}</span>
                                </td>
                                <td style="padding: 14px 20px; text-align: center; vertical-align: middle;">
                                    <span style="font-weight: 700; color: #1a0e34;">{{ $deck->active_questions_count }}</span>
                                    @if($deck->questions_count > $deck->active_questions_count)
                                        <span style="font-size: 11px; color: #8b849e;">({{ $deck->questions_count - $deck->active_questions_count }} hidden)</span>
                                    @endif
                                </td>
                                <td style="padding: 14px 20px; vertical-align: middle;">
                                    @if($deck->isPublished())
                                        <span class="badge" style="background: #d1f5e0; color: #0f7c3f; padding: 5px 12px; border-radius: 999px; font-weight: 600;">
                                            <?= __tr("Published") ?>
                                        </span>
                                    @else
                                        <span class="badge" style="background: #f0ecf7; color: #8b849e; padding: 5px 12px; border-radius: 999px; font-weight: 600;">
                                            <?= __tr("Draft") ?>
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 14px 20px; text-align: right; vertical-align: middle;">
                                    <a href="<?= route('manage.icebreakers.decks.edit', ['deck' => $deck->_uid]) ?>" class="btn btn-sm" style="background: #6b3fd6; color: white; border-radius: 999px; padding: 5px 14px; font-weight: 600; font-size: 12px;">
                                        <?= __tr("Edit") ?>
                                    </a>
                                    <form action="<?= route('manage.icebreakers.decks.destroy', ['deck' => $deck->_uid]) ?>" method="POST" style="display: inline;" onsubmit="return confirm('<?= __tr('Delete this deck and all its questions?') ?>');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm" style="background: white; color: #e91e63; border: 1px solid #ffe0ea; border-radius: 999px; padding: 5px 14px; font-weight: 600; font-size: 12px; margin-left: 4px;">
                                            <?= __tr("Delete") ?>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
