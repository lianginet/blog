<template>
    <div class="content-container">
        <div class="desc">
            无法记住太多命令？This is personal memo！
        </div>
        <ul class="wiki-list">
            <li v-for="i in 10" class="wiki-item">
                <router-link to="link1" class="wiki-item-link">文章链接{{ i }}</router-link>
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                msg: 'This is the wiki page!'
            }
        }
    }
</script>

<style lang=scss scoped>
    .desc {
        font-size: 16px;
        color: #888;
        border-left: 6px solid #ddd;
        text-indent: 20px;
        line-height: 2;
    }
    .wiki-list {
        list-style-type: disc;
        padding-left: 25px;
        .wiki-item {
            font-size: 15px;
            line-height: 2;
            .wiki-item-link {
                text-decoration: none;
                color: lighten(#1D8CE0, 5%);
                &:hover {
                    text-decoration: underline;
                }
            }
        }
    }
</style>
