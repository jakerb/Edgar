class EdgarFieldModel {

    id;
    components = [];
    name;
    slug;
    type = 'text';
    options = [];
    default;
    placeholder;
    value;
    conditional_logic = [];
    classes = [];
    ui_width = 100;
    ui_position = 0;

    constructor(data) {
        let keys = Object.keys(data);
        keys.forEach((key) => {
            this[key] = data[key];
        });
    }

    toObject() {
        return {
            id: this.id,
            components: this.components,
            name: this.name,
            type: this.type,
            options: this.options,
            default: this.default,
            placeholder: this.placeholder,
            value: this.value,
            conditional_logic: this.conditional_logic,
            classes: this.classes,
            ui_width: this.ui_width,
            ui_position: this.ui_position
        };
    }

}