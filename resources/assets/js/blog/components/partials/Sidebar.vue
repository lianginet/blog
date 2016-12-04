<template>
    <div class="sidebar-container">
        <v-search></v-search>
        <v-category></v-category>
        <v-tag></v-tag>
        <v-wiki></v-wiki>
        <section class="about-section">
            <!--关于我部分-->
        </section>
    </div>
</template>

<script>
    import VSearch from './sidebar/Search'
    import VCategory from './sidebar/Category'
    import VTag from './sidebar/Tag'
    import VWiki from './sidebar/Wiki'

    export default {
        components: {
            VSearch,
            VCategory,
            VTag,
            VWiki
        }
    }
</script>

<style lang=scss>
    .sidebar-container {
        section {
            margin-bottom: 10px;
            .el-card__body {
                padding: 12px !important;
                .card-item {
                    padding: 8px 0;
                }
            }
        }
        .title {
            line-height: 2;
            font-size: 15px;
            margin-left: 2px;
        }
    }
</style>