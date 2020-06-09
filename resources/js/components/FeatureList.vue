<template>
    <ul>
        <li v-for="productFeature in children"
            :feature-id="productFeature.id"
            :feature="productFeature.feature"
            :children="productFeature.children"
        >
            {{ productFeature.feature }} || defined children: {{ productFeature.children !== undefined }} || length of children: {{ productFeature.children.length }}
        </li>
        <feature-list v-if="productFeature.children !== undefined">
        </feature-list>
    </ul>
</template>

<!--
function printFeatures(array $items, $parentId, $result) {
    foreach ($items as $item) {
        if ($item["parent_id"] == $parentId) {
            $result .= "<li>";
            $result .= $item["feature"];
            $result .= "<ul>";
            $result = printFeatures($items, $item["id"], $result);
            $result .= "</ul></li>";
        }
    }
    return $result;
}
-->


<script>
    export default {
        name: 'feature-list',
        data() {
            return {
                shared: store,
                productFeatures: {},
            };
        },
        props: ['feature-id', 'feature', 'children'],
        mounted() {
            // Make an ajax request to our server - /features/{productLineId}/{includeInactive?}
            let url = '/features/' + this.shared.state.productLine.id;
            axios.get(url).then(response => this.productFeatures = response.data);
        },
        methods: {
            notAChild(productFeature) {
                console.log(this.shared.state.previousId);
                console.log(productFeature);
                productFeature.product_features_pivot.forEach(pivot => {
                    if (pivot.parent_id === this.shared.state.previousId) {
                        return false;
                    }
                });
                this.shared.state.previousId = productFeature.id;
                // console.log(productFeature.id);
                return true;
            },
        },
    }
</script>