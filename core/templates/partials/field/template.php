<section class="tab" ng-class="active == 'field' ? 'active' : ''" ng-controller="metaboxField">
    <div class="field">
        <div>
            <div class="label">
                <label for="">Field Type</label>
            </div>
            <div class="input">
                <select ng-model="field.type" name="edgar_field[{{field.id}}][type]" ng-change="getFieldType(field.type)">
                    <?php foreach($edgar->get_field_categories() as $category) { ?>
                    <optgroup label="<?php echo $category['name']; ?>">
                        <?php foreach($edgar->get_field_types() as $type) { ?>
                        <?php if($type->category !== $category['slug']) { continue; } ?>
                        <option value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
                        <?php } ?>
                    </optgroup>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="field">
        <div>
            <div class="label">
                <label for="">Field Name <required></required></label>
            </div>
            <div class="input">
                <input ng-model="field.name" name="edgar_field[{{field.id}}][name]" type="text">
            </div>
        </div>
    </div>
    <div class="field slug">
        <div>
            <div class="label">
                <label for="">Field Slug <required></required></label>
            </div>
            <div class="input">
                <input type="text" name="edgar_field[{{field.id}}][slug]" ng-model="field.slug">
            </div>
            <div>
                <a href="#/" class="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                </a>
            </div>
        </div>
        
    </div>

    <div class="field" ng-repeat="props in field_type.properties">
        <div>
            <div class="label">
                <label for=""><span ng-bind="props.name"></span> <required ng-if="props.required"></required></label>
            </div>
            <div class="input">
                <!-- Input -->
                <input type="text" name="edgar_field[{{field.id}}][{{props.slug}}]" ng-required="props.required" ng-if="props.type == 'text'">
                <!-- Input -->

                <!-- Textarea -->
                <textarea ng-required="props.required" name="edgar_field[{{field.id}}][{{props.slug}}]" ng-if="props.type == 'textarea'"></textarea>
                <!-- Textarea -->

                <!-- Boolean -->
                <span ng-if="props.type == 'boolean'">I'm a boolean</span>
                <!-- Boolean -->

                <!-- Checkbox -->
                <div ng-if="props.type == 'checkbox'">
                    <div>
                        <label for="">
                            <input name="edgar_field[{{field.id}}][{{props.slug}}]" type="checkbox">
                        </label>
                    </div>
                </div>
                <!-- Checkbox -->

                <p ng-if="props.instruction"><small ng-bind="props.instruction"></small></p>
            </div>
        </div>
    </div>
    
    <div class="field">
        <div>
            <div class="label">
                <label for="">Field ID</label>
            </div>
            <div class="input">
                <input type="text" readonly name="edgar_field[{{field.id}}][id]" ng-model="field.id">
            </div>
        </div>
    </div>
</section>