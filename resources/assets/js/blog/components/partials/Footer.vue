<template>
    <footer>
        <div class="footer-container">
            <span class="left">
                <span>© 2016 Lianginet</span>
                <router-link to="/"><el-button type="text">首页</el-button></router-link>
                <router-link to="/categories"><el-button type="text">分类</el-button></router-link>
                <router-link to="/tags"><el-button type="text">标签</el-button></router-link>
                <router-link to="/wiki"><el-button type="text">维基</el-button></router-link>
                <router-link to="/about"><el-button type="text">关于</el-button></router-link>
            </span>
            <span class="center">
                <a target="__blank" :href="github" class="github-link">
                    <i class="iconfont icon-github"></i>
                </a>
            </span>
            <span class="right">
                <el-button type="text" @click="scrollToTop">TOP</el-button>
            </span>
        </div>
    </footer>
</template>

<script>
    export default {
        props: {
            github: String
        },
        methods: {
            scrollToTop() {
                document.body.scrollTop = 0;
            }
        }
    }
</script>

<style lang=scss scoped>
    footer {
        position: relative;
        margin-top: 30px;
    }
    .footer-container {
        margin: 0 auto;
        width: 1050px;
        font-size: 12px;
        border-top: 1px solid #ccc;
        line-height: 80px;
        & .el-button, & > span {
            font-size: 12px;
            margin-left: 5px;
        }
        .left {
            float: left;
        }
        .right {
            float: right;
        }
        .center {
            position: absolute;
            left: 48%;
            margin-left: 0;
            a.github-link {
                color: #555;
                text-decoration: none;
                .iconfont {
                    font-size: 24px;
                    color: #888;
                    &:hover {
                        color: #555;
                    }
                }
            }
        }
    }
</style>