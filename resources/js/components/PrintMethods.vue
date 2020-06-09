<template>
    <!--<h1 class="accented">{{ productLines[1].product_subcategory.long_name }}</h1>-->
    <div>
        <h4 class="is-accented">printed with:</h4>
        <a v-for="methodButton in methodButtons" href="#" :id="'link-' + methodButton.productLine.print_method_id" :class="['method-button', { selected: methodButton.isSelected }]" :data-method="methodButton.productLine.print_method_id" @click="selectButton(methodButton)">
            <h1>{{ methodButton.productLine.print_method.long_name }}</h1>
            <h5>{{ methodButton.productLine.print_method.short_description }}</h5>
        </a>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                methodButtons: [],
                shared: store,
            };
        },
        created() {
            this.methodButtons = this.$children;
        },
        mounted() {
            this.methodButtons.forEach(methodButton => {
                if (methodButton.isSelected) {
                    this.shared.setProductLine(methodButton.productLine);
                }
            });
        },
        methods: {
            selectButton (button) {
                this.methodButtons.forEach(methodButton => {
                    methodButton.isSelected = (methodButton.productLine.print_method_id === button.productLine.print_method_id);
                    if (methodButton.isSelected) {
                        this.shared.setProductLine(methodButton.productLine);
                    }
                });
            }
        }
    }
</script>
