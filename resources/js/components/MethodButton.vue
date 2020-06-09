<template>
    <div>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: {
            productLine: { required: true },
            minPriority: { required: true },
            selected: { default: false },
        },
        data() {
            return {
                isSelected: this.productLine.print_method.priority === this.minPriority,
            };
        },
    }
</script>