<template>
    <div class="nav">
        <div class="logo">
            <i class="iconfont icon-favicon logo-icon"></i>
            <span class="logo-text">Markdown notes</span>
        </div>
        <div class="logout">
            <i class="iconfont icon-exit" @click="logout"></i>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    export default {
        methods: {
            logout() {
                this.$router.push('/auth')
            }
        }
    }
</script>

<style lang=scss scoped>
    .nav {
        height: 50px;
        .logo {
            float: left;
            & > i {
                position: absolute;
                font-size: 24px;
                margin-top: -1px;
            }
            & > .logo-text {
                font-size: 16px;
                margin-left: 30px;
            }
        }
        .logout {
            float: right;
            color: #888;
            i {
                font-size: 20px;
            }
        }
    }
</style>