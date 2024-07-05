<?php global $edgar; ?>
<div class="edgar-template-editor" ng-app="edgar">

    <main id="edgar-templates">

        <div class="row">
            <div class="col" ng-controller="metaboxFieldList">
                <section class="field" ng-class="active.id == item.id ? 'active' : ''"
                    ng-repeat="item in fields track by $index">
                    <header>
                        <div>
                            <a href="#/" class="reorder">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </a>
                            <h4>
                                <a href="#/" ng-bind="item.name || 'Untitled Field'" ng-click="select(item.id)"></a>
                            </h4>
                        </div>
                        <div>
                            <a href="#/" ng-click="select(item.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </div>
                    </header>
                </section>
                <section class="field">
                    <header>
                        <div>
                            <h4>
                                <a href="#/" ng-click="create()">Add Field</a>
                            </h4>
                        </div>
                        <div>
                            <a href="#/">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </div>
                    </header>
                </section>
            </div>
            <div class="col">

                <div class="tabs" ng-controller="metaboxTabContainer">

                    <header>
                        <a ng-class="active == 'field' ? 'active' : ''" ng-click="switch('field')">Field</a>
                        <a ng-class="active == 'appearance' ? 'active' : ''" ng-click="switch('appearance')">Appearance</a>
                        <a ng-class="active == 'visibility' ? 'active' : ''" ng-click="switch('visibility')">Visibility</a>
                        <a ng-class="active == 'settings' ? 'active' : ''" ng-click="switch('settings')">Settings</a>
                        <a ng-class="active == 'preview' ? 'active' : ''" ng-click="switch('preview')">Preview</a>
                        <div>
                            <button type="button" ng-click="sync()" class="button button-primary button-large">Save
                                Changes
                            </button>
                        </div>
                    </header>

                    <?php require_once(__DIR__ . '/partials/field/template.php'); ?>

                </div>



            </div>
        </div>

    </main>
    <footer>
        <a href="javascript:alert(1)" class="button">Add Field</a>
        <a href="javascript:alert(1)" class="button">Arrange</a>
    </footer>

</div>