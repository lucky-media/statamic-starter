export const Demo = ({ param }) => ({
    demo: false,

    init() {
        this.demo = param;
    },
});
