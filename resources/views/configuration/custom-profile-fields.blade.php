<style>
/* SweetAlert Custom Styling */
.swal2-popup {
    background: white !important;
    color: #374151 !important; /* text-lw-primary equivalent */
    border-radius: 0.75rem !important;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
}

.swal2-title {
    color: #374151 !important; /* text-lw-primary */
    font-weight: 600 !important;
}

.swal2-html-container {
    color: #6b7280 !important; /* text-gray-500 */
}

.swal2-confirm {
    background-color: #dc2626 !important; /* bg-red-600 for delete */
    color: white !important;
    border-radius: 0.5rem !important;
    padding: 0.5rem 1rem !important;
    font-weight: 500 !important;
}

.swal2-confirm:hover {
    background-color: #b91c1c !important; /* bg-red-700 */
}

.swal2-cancel {
    background-color: #f3f4f6 !important; /* bg-gray-100 */
    color: #374151 !important; /* text-lw-primary */
    border-radius: 0.5rem !important;
    padding: 0.5rem 1rem !important;
    font-weight: 500 !important;
    border: 1px solid #d1d5db !important;
}

.swal2-cancel:hover {
    background-color: #e5e7eb !important; /* bg-gray-200 */
}

.swal2-actions {
    gap: 0.75rem !important;
}

.swal2-icon.swal2-warning {
    border-color: #f59e0b !important; /* amber-500 */
    color: #f59e0b !important;
}

.swal2-icon.swal2-error {
    border-color: #dc2626 !important; /* red-600 */
    color: #dc2626 !important;
}

.swal2-icon.swal2-question {
    border-color: #3b82f6 !important; /* blue-500 */
    color: #3b82f6 !important;
}

/* Override any dark backgrounds */
.swal2-container {
    background-color: rgba(0, 0, 0, 0.4) !important;
}
</style>

<!-- Modern Custom Profile Field Settings Page -->
<div class="max-w-6xl mx-auto">
    <!-- Page Header -->
    <x-lw.card class="mb-6">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-lw p-3 rounded-full">
                <i class="fas fa-user-cog text-white text-xl"></i>
            </div>
            <div>
                <h1 class="font-lw font-bold text-2xl text-lw-primary">{{ __tr('Custom Profile Field Settings') }}</h1>
            </div>
        </div>
    </x-lw.card>

    <!-- Custom Profile Fields Form -->
    <form class="lw-ajax-form lw-form temp-lw-ajax-form-ready" method="post"
        action="{{ route('manage.custom_fields.write', ['pageType' => request()->pageType]) }}"
        data-on-close-update-models='["items" => []]'>

        <div x-data="{ items : @lwJson($configurationData) }">
            <div class="mb-6 flex justify-end">
                <x-lw.button type="button" variant="primary" size="sm" data-toggle="modal"
                    data-target="#addNewSection" data-response-template="#lwAddNewSectionBody"
                    x-on:click.prevent="addSection()">
                    <i class="fas fa-plus mr-2"></i>
                    {{ __tr('Add New Section') }}
                </x-lw.button>
            </div>

            <div class="space-y-6">
                <template x-for="(group, index) in items.groups">
                    <x-lw.card class="lw-custom-field-section">
                        <!-- Section Header -->
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                            <div>
                                <h4 class="text-xl font-semibold text-lw-primary" x-text="group.title"></h4>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="inline-flex items-center px-3 py-2 border border-amber-300 text-sm leading-4 font-medium rounded-md text-amber-700 bg-amber-50 hover:bg-amber-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 lw-ajax-link-action temp-lw-ajax-form-ready" 
                                    data-toggle="modal" data-target="#editNewSection" data-response-template="#lwEditNewSectionBody"
                                    x-on:click.prevent="editSection(group.title, index)"
                                    x-bind:href="__Utils.apiURL('{{ route('addEdit.item.read.update.data', ['groupName' => 'groupName', 'itemPos' => 'null']) }}', { 'groupName': index })">
                                    <i class="fa fa-pencil-alt mr-1"></i> 
                                    {{ __tr('Edit Section') }}
                                </button>
                                
                                <button class="inline-flex items-center px-3 py-2 border border-red-300 text-sm leading-4 font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 lw-ajax-link-action temp-lw-ajax-form-ready"
                                    x-on:click.prevent="deleteField(group.title, group.unDeletableKey)" 
                                    data-confirm="#lwDeleteContainer"
                                    x-bind:href="__Utils.apiURL('{{ route('field.write.delete', ['groupName', 'itemPos', 'field' => 'group']) }}', { 'groupName': index, 'itemPos':null })"
                                    data-callback="onSuccessCallback">
                                    <i class="fas fa-trash mr-1"></i> 
                                    {{ __tr('Delete Section') }}
                                </button>
                                
                                <template x-if="!group.groups">
                                    <x-lw.button type="button" variant="primary" size="sm" data-toggle="modal" data-target="#addEditItems"
                                        data-response-template="#lwAddEditItemsBody" x-on:click.prevent="addItems(group.title, index)">
                                        <i class="fas fa-plus mr-1"></i>
                                        {{ __tr('Add New Item') }}
                                    </x-lw.button>
                                </template>
                            </div>
                        </div>

                        <!-- Section Items -->
                        <div class="space-y-6">
                            <template x-for="(item, idx) in group.items">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h5 class="text-lg font-medium text-lw-primary mb-3" x-text="item.name"></h5>
                                            
                                            <div class="flex items-center space-x-2 mb-4">
                                                <button class="inline-flex items-center px-3 py-2 border border-blue-300 text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 lw-ajax-link-action temp-lw-ajax-form-ready"
                                                    data-toggle="modal" data-target="#addEditItems" data-response-template="#lwAddEditItemsBody"
                                                    x-on:click.prevent="addItems('Edit Item', index)"
                                                    x-bind:href="__Utils.apiURL('{{ route('addEdit.item.read.update.data', ['groupName' => 'groupName', 'itemPos' => 'itemPos']) }}', { 'groupName': index, 'itemPos':idx })">
                                                    <i class="fa fa-pencil-alt mr-1"></i> 
                                                    {{ __tr('Edit Item') }}
                                                </button>
                                                
                                                <button class="inline-flex items-center px-3 py-2 border border-red-300 text-sm leading-4 font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 lw-ajax-link-action temp-lw-ajax-form-ready"
                                                    x-on:click.prevent="deleteField(item.name, group.unDeletableKey)" 
                                                    data-confirm="#lwDeleteContainer"
                                                    x-bind:href="__Utils.apiURL('{{ route('field.write.delete', ['groupName', 'itemPos', 'field' => 'item']) }}', { 'groupName': index, 'itemPos':idx })"
                                                    data-callback="onSuccessCallback">
                                                    <i class="fas fa-trash mr-1"></i> 
                                                    {{ __tr('Delete Item') }}
                                                </button>
                                            </div>

                                            <!-- Options Management -->
                                            <div class="mt-4">
                                                <template x-if="item.options != null">
                                                    <div class="flex items-center space-x-2 mb-3">
                                                        <button class="inline-flex items-center px-3 py-2 border border-purple-300 text-sm leading-4 font-medium rounded-md text-purple-700 bg-purple-50 hover:bg-purple-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 lw-ajax-link-action temp-lw-ajax-form-ready"
                                                            data-toggle="modal" data-target="#editOptions" data-response-template="#lweditOptionsBody"
                                                            x-on:click.prevent="addOptions(group.title, index)"
                                                            x-bind:href="__Utils.apiURL('{{ route('addEdit.item.read.update.data', ['groupName'=>'groupName', 'itemPos' => 'itemPos']) }}', { 'groupName': index, 'itemPos':idx })">
                                                            <i class="fa fa-pencil-alt mr-1"></i> 
                                                            {{ __tr('Manage Options') }}
                                                        </button>
                                                        
                                                        <button class="inline-flex items-center px-3 py-2 border border-red-300 text-sm leading-4 font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 lw-ajax-link-action temp-lw-ajax-form-ready"
                                                            x-on:click.prevent="deleteField('options', group.unDeletableKey)" 
                                                            data-confirm="#lwDeleteContainer"
                                                            x-bind:href="__Utils.apiURL('{{ route('field.write.delete', ['groupName', 'itemPos', 'field' => 'options']) }}', { 'groupName': index, 'itemPos':idx })"
                                                            data-callback="onSuccessCallback">
                                                            <i class="fas fa-trash mr-1"></i> 
                                                            {{ __tr('Delete All Options') }}
                                                        </button>
                                                    </div>
                                                </template>
                                                
                                                <template x-if="item.input_type != 'textbox'">
                                                    <x-lw.button type="button" variant="primary" size="sm" 
                                                        class="lw-ajax-link-action temp-lw-ajax-form-ready"
                                                        data-toggle="modal" data-target="#addOptions"
                                                        data-response-template="#lwAddOptionsBody"
                                                        x-on:click.prevent="addOptions(group.title, index)"
                                                        x-bind:href="__Utils.apiURL('{{ route('addEdit.item.read.update.data', ['groupName'=>'groupName', 'itemPos' => 'itemPos']) }}', { 'groupName': index, 'itemPos':idx })">
                                                        <i class="fas fa-plus mr-1"></i>
                                                        {{ __tr('Add New Options') }}
                                                    </x-lw.button>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </x-lw.card>
                </template>
            </div>
        </div>
    </form>
</div>

<!-- Delete Confirmation Modal Content -->
<div id="lwDeleteContainer" style="display: none;">
    <h3>{{ __tr('Are You Sure!') }}</h3>
    <strong id="confirmationText"></strong>
</div>

<!-- Add/Edit Items Modal -->
<div class="modal fade modelSuccessCallback" id="addEditItems" tabindex="-1" role="dialog" aria-labelledby="addItemsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header bg-gray-50 border-b border-gray-200">
                <h5 class="modal-title text-lw-primary font-semibold" id="groupName"></h5>
                <button type="button" class="close text-gray-400 hover:text-gray-600" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="lw-ajax-form lw-form" data-show-processing="true" method="post" data-callback="onSuccessCallback"
            action="{{ route('manage.custom_fields.write', ['pageType' => request()->pageType]) }}">
            <div class="modal-body">
                    <input type="hidden" name="title" id="hiddenGroupName" />
                    <input type="hidden" name="type" value="items" />
                    <div class="lw-form-modal-body" id="addItems" x-data='{itemValues : []}'>
                        <template x-if="itemValues.length == 0">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div>
                                    <x-lw.form-field label="{{ __tr('Item Name') }}" name="items[name]">
                                        <x-lw.input type="text" name="items[name]" 
                                            class="itemName" 
                                            placeholder="{{ __tr('Name') }}" 
                                            required />
                                    </x-lw.form-field>
                                </div>
                                <div>
                                    <x-lw.form-field label="{{ __tr('Input Type') }}" name="items[input_type]">
                                        <select required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-white text-lw-primary" 
                                            id="lwSelectInputType" name="items[input_type]">
                                            <option value="random" class="text-lw-primary">
                                                {{ __tr('Select a Input Type') }}
                                            </option>
                                            <option value="select" class="text-lw-primary">
                                                {{ __tr('Select') }}
                                            </option>
                                            <option value="textbox" class="text-lw-primary">
                                                {{ __tr('Textbox') }}
                                            </option>
                                        </select>
                                    </x-lw.form-field>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="lw-form-modal-body">
                        <div x-data='{itemValues : []}'>
                            <template x-for="(item, index) in itemValues" :key="index">
                                <div>
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">
                                        <div>
                                            <input type="hidden" x-model="item.itemName" x-bind:name="'items[key]'">
                                            <input type="hidden" x-model="item.itemData.input_type"
                                                x-bind:name="'items[input_type]'">
                                            <x-lw.form-field label="{{ __tr('Item Name') }}" name="items[name]">
                                                <x-lw.input type="text" 
                                                    x-model="item.itemData.name"
                                                    x-bind:name="'items[name]'"
                                                    placeholder="{{ __tr('name') }}"
                                                    required />
                                            </x-lw.form-field>
                                        </div>
                                        <div>
                                            <x-lw.form-field label="{{ __tr('Input Type') }}" name="items[input_type]">
                                                <select required x-model="item.itemData.input_type" disabled
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-100 text-lw-primary"
                                                    id="lwFixedInputType">
                                                    <option value="random" class="text-lw-primary">
                                                        {{ __tr('Select a Input Type') }}
                                                    </option>
                                                    <option value="select" class="text-lw-primary">
                                                        {{ __tr('Select Field') }}
                                                    </option>
                                                    <option value="textbox" class="text-lw-primary">
                                                        {{ __tr('Textbox') }}
                                                    </option>
                                                </select>
                                            </x-lw.form-field>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
            </div>
            <div class="modal-footer bg-gray-50 border-t border-gray-200">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">
                    {{ __tr('Cancel') }}
                </button>
                <button class="btn btn-primary btn-sm">
                    {{ __tr('Save') }}
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Add New Section Modal -->
<div class="modal fade modelSuccessCallback" id="addNewSection" tabindex="-1" role="dialog"
    aria-labelledby="addNewSectionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header bg-gray-50 border-b border-gray-200">
                <h5 class="modal-title text-lw-primary font-semibold" id="exampleModalLabel">
                    {{ __tr('Add New Section') }}
                </h5>
                <button class="close text-gray-400 hover:text-gray-600" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="lw-ajax-form lw-form" method="post" data-callback="addSectionCallback" id="addSectionForm"
                    action="{{ route('add.new.section', ['pageType' => request()->pageType]) }}">
                    <div class="mt-1" x-data='{groupData : []}'>
                        <div class="space-y-4">
                            <x-lw.form-field label="{{ __tr('Profile Section Name') }}" name="title">
                                <x-lw.input type="text" name="title" placeholder="{{ __tr('Profile Section Name') }}" required />
                            </x-lw.form-field>
                            
                            <div>
                                <div class="flex items-center">
                                    <input type="hidden" name="status" value="0">
                                    <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" id="enableSection" name="status" value="1">
                                    <label class="ml-2 block text-sm font-medium text-lw-primary" for="enableSection">
                                        {{ __tr('Active') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-gray-50 border-t border-gray-200">
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">
                            {{ __tr('Cancel') }}
                        </button>
                        <button class="btn btn-primary btn-sm">
                            {{ __tr('Add') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Options Modal -->
<div class="modal fade modelSuccessCallback" id="addOptions" tabindex="-1" role="dialog" aria-labelledby="addNewOptionsLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header bg-gray-50 border-b border-gray-200">
                <h5 class="modal-title text-lw-primary font-semibold" id="exampleModalLabel">
                    {{ __tr('Add New Options') }}
                </h5>
                <button class="close text-gray-400 hover:text-gray-600" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="lw-ajax-form lw-form" method="post" data-callback="onSuccessCallback"
                    action="{{ route('manage.custom_fields.write', ['pageType' => request()->pageType]) }}">
            <div class="modal-body" x-data='{item : [], fields : []}'>
                    <template x-if="item.itemData != null">
                        <div class="space-y-4">
                            <template x-for="(itemValue, itemValueIndex) in fields" :key="itemValueIndex">
                                <div>
                                    <div class="flex">
                                        <input type="text" required x-bind:name="'options['+itemValueIndex+'][option]'"
                                            class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="{{ __tr('Option') }}" />
                                        <input type="hidden" name="type" value="options" />
                                        <input type="hidden" x-model="item.groupName" x-bind:name="'title'">
                                        <input type="hidden" x-model="item.itemName" x-bind:name="'itemName'">
                                        <input type="hidden" x-model="item.itemData.name" x-bind:name="'items[name]'">
                                        <input type="hidden" x-model="item.itemData.input_type"
                                            x-bind:name="'items[input_type]'">
                                        <input type="hidden" x-bind:name="'options['+itemValueIndex+'][optionKey]'">
                                        <button type="button" class="px-3 py-2 bg-red-500 text-white rounded-r-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500"
                                            x-on:click.prevent="fields.splice(itemValueIndex, 1)">&times;</button>
                                    </div>
                                </div>
                            </template>
                            <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                x-on:click.prevent="fields.push({option:''})">
                             <i class="fa fa-plus mr-2"></i>   
                             {{ __tr('Add Options') }}
                            </button>
                        </div>
                    </template>
            </div>
            <div class="modal-footer bg-gray-50 border-t border-gray-200">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">
                    {{ __tr('Cancel') }}
                </button>
                <button class="btn btn-primary btn-sm ">
                    {{ __tr('Save') }}
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Edit Options Modal -->
<div class="modal fade modelSuccessCallback" id="editOptions" tabindex="-1" role="dialog" aria-labelledby="editOptionsLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header bg-gray-50 border-b border-gray-200">
                <h5 class="modal-title text-lw-primary font-semibold" id="exampleModalLabel">
                    {{ __tr('Edit Options') }}
                </h5>
                <button class="close text-gray-400 hover:text-gray-600" type="button" data-dismiss="modal" aria-label="{{ __tr('Close') }}">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="lw-ajax-form lw-form" method="post" data-callback="onSuccessCallback"
                    action="{{ route('manage.custom_fields.write', ['pageType' => request()->pageType]) }}">
            <div class="modal-body" x-data='{item : []}'>
                    <template x-if="item.itemData != null">
                        <div class="space-y-4">
                            <input type="hidden" name="type" value="edit-option" />
                            <input type="hidden" x-model="item.groupName" x-bind:name="'title'">
                            <input type="hidden" x-model="item.itemName" x-bind:name="'itemName'">
                            <input type="hidden" x-model="item.itemData.name" x-bind:name="'items[name]'">
                            <input type="hidden" x-model="item.itemData.input_type" x-bind:name="'items[input_type]'">
                            <template x-for="(itemValue, itemValueIndex) in item.itemData.options"
                                :key="itemValueIndex">
                                <div class="flex">
                                    <input type="text" x-model="itemValue.option" required
                                        x-bind:name="'options['+itemValueIndex+'][option]'"
                                        class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="{{ __tr('options') }}" />
                                        <input type="hidden" x-model="itemValue.key"
                                            x-bind:name="'options['+itemValueIndex+'][optionKey]'">
                                    <button type="button" class="px-3 py-2 bg-red-500 text-white rounded-r-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500"
                                        x-on:click.prevent="item.itemData.options.splice(itemValueIndex, 1)">&times;</button>
                                </div>
                            </template>
                        </div>
                    </template>
            </div>
            <div class="modal-footer bg-gray-50 border-t border-gray-200">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">
                    {{ __tr('Cancel') }}
                </button>
                <button class="btn btn-primary btn-sm">
                    {{ __tr('Update') }}
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Edit Section Modal -->
<div class="modal fade modelSuccessCallback" id="editNewSection" tabindex="-1" role="dialog" aria-labelledby="editNewSectionLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header bg-gray-50 border-b border-gray-200">
                <h5 class="modal-title text-lw-primary font-semibold" id="exampleModalLabel">
                    {{ __tr('Edit Section') }}
                </h5>
                <button class="close text-gray-400 hover:text-gray-600" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="lw-ajax-form lw-form" data-show-processing="true" method="post" data-callback="onSuccessCallback"
            action="{{ route('add.new.section', ['pageType' => request()->pageType]) }}">
            <div class="modal-body">
                    <input type="hidden" name="groupIndex" value="" id="sectionName">
                    <div class="mt-1" x-data='{groupData : []}'>
                        <template x-if="groupData.title != null">
                            <div class="space-y-4">
                                <x-lw.form-field label="{{ __tr('Profile Section Name') }}" name="title">
                                    <x-lw.input type="text" 
                                        x-model="groupData.title" 
                                        name="title"
                                        placeholder="{{ __tr('Profile Section Name') }}" 
                                        required />
                                </x-lw.form-field>
                                
                                <div>
                                    <div class="flex items-center">
                                        <input type="hidden" name="status" value="0">
                                        <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" id="editEnableSection" name="status" value="1" x-bind:checked="groupData.status == 1">
                                        <label class="ml-2 block text-sm font-medium text-lw-primary" for="editEnableSection">
                                            {{ __tr('Active') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
            </div>
            <div class="modal-footer bg-gray-50 border-t border-gray-200">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">
                    {{ __tr('Cancel') }}
                </button>
                <button type="submit" class="btn btn-primary btn-sm">
                    {{ __tr('Update') }}
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

@lwPush('appScripts')
<script>

    function addSection() {
        __DataRequest.updateModels({'groupData' : []});
    }
    function addItems(groupName, title) {
        // console.log(groupName, title);
        $("#groupName").text(groupName);
        $("#hiddenGroupName").val(title);
        $(".itemName").val('');
        $('select#lwSelectInputType').val("random").change();

        __DataRequest.updateModels({'itemValues' : []});
    }

    function addOptions(groupName, title) {
        __DataRequest.updateModels({'fields' : []});
    }

    function editSection(groupName, index) {
        $("#sectionName").val(index);
    }

    function onSuccessCallback(response) {
        if(response.reaction == 1){
            $('.modelSuccessCallback').modal('hide');
        }
    }
    function addSectionCallback(response) {
        if (response.reaction == 1) {
            $('#addSectionForm')[0].reset();
            $('.modelSuccessCallback').modal('hide');
        }
    }

    function deleteField(groupName, isDeletable) {
        var $confirmationText = $('#confirmationText');

        if(typeof isDeletable != 'undefined'){
            var oldText = "{{ __tr('You cannot delete this __text__. Because is system generated either you enable or disable it') }}";
        }else{
            var oldText = "{{ __tr('You want to delete this __text__.') }}";
        }

        // Replace the old text with the new text
        var newText = oldText.replace('__text__', groupName);
        // Set the new text inside the confirmationText
        $confirmationText.text(newText);
    }
</script>
@lwPushEnd