<template>
    <div class="nav">
        <div class="logo">
            <i class="iconfont icon-favicon logo-icon"></i>
            <span class="logo-text">简易 Markdown 笔记</span>
        </div>
    </div>
</template>
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
    }
</style>