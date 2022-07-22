document.addEventListener('alpine:init', () => {
    Alpine.data('select2Component', (
        placeholder = '--- Select ---',
        multiple = false,
    ) => ({
        multiple: multiple,
        options: [],
        selected: '',
        placeholder: {
            id: "",
            text: placeholder,
            selected:'selected'
        },
        setOptions(options) {
            this.options = [{
                id: "",
                text: '',
                search: '',
                selected: 'selected',
                hidden: true
            }].concat(options)
        },
        init() {
            // Watch for options update
            let observer = new MutationObserver((mutationList, observer) => {
                for(const mutation of mutationList) {
                    if (mutation.type === 'attributes' && mutation.attributeName == 'data-options') {
                        this.setOptions(JSON.parse($(this.$refs.select).attr('data-options')))
                        // bugfix inital select
                        this.selected = this.$refs.select._x_model.get()
                    }
                }
            })
            observer.observe(this.$el, { attributes: true })

            // set initial selected
            let select = $(this.$refs.select)
            this.$nextTick(() => {
                this.selected = this.$refs.select._x_model.get()
            })

            $(select).wrap('<div class="position-relative"></div>');
            let loadSelect = () => {
                let selected = this.multiple ? this.selected : [this.selected];
                select.select2({
                    multiple: this.multiple,
                    data: this.options.map(i => ({
                        id: i.id,
                        text: i.name,
                        selected: selected.map(i => String(i)).includes(String(i.id)),
                    })),
                    allowClear: true,
                    dropdownAutoWidth: true,
                    dropdownParent: $(select).parent(),
                    width: '100%',
                    placeholder: this.placeholder,
                })
            }
            let reloadSelect = () => {
                $(this.$refs.select).select2('destroy');
                this.$refs.select.innerHTML = '';
                loadSelect();

                this.$refs.select._x_model.set(this.selected)
            }
            loadSelect();
            select.on("change", (e) => {
                let currentSelection = select.select2('data')
                this.selected = this.multiple ? [] : ''
                if(currentSelection.length > 0) {
                    this.selected = this.multiple ? currentSelection.map(i => i.id) : currentSelection[0].id;
                }
            });
            this.$watch('selected', () => reloadSelect());
            this.$watch('options', () => reloadSelect());
        },
    }))
});
