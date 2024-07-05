class EdgarFieldTypeModel {

    name;
    slug;
    properties = [];
    category;
    className;
    instruction;

    constructor(data) {
        let keys = Object.keys(data);
        keys.forEach((key) => {
            this[key] = data[key];
        });
    }

    toObject() {
        return {
            name: this.name,
            slug: this.slug,
            properties: this.properties,
            category: this.category,
            className: this.className,
            instruction: this.instruction
        };
    }

}