<template>
    <header>
        <div class="header-container">
            <div class="logo">
                <i class="iconfont icon-github"></i>
                <span class="text">Lianginet</span>
            </div>
            <el-menu :default-active="$route.path" class="el-menu-demo" mode="horizontal" router>
                <el-menu-item index="/">首页</el-menu-item>
                <el-menu-item index="/categories">分类</el-menu-item>
                <el-menu-item index="/tags">标签</el-menu-item>
                <el-menu-item index="/wiki">维基</el-menu-item>
                <el-menu-item index="/about">关于</el-menu-item>
            </el-menu>
        </div>
    </header>
</template>
<style lang=scss scoped>
    header {
        width: 100%;
        font-size: 15px;
        background: #1D8CE0;
        overflow: hidden;
    }
    .header-container {
        width: 1050px;
        margin: 0 auto;
        .logo {
            float: left;
            color: #fff;
            font-size: 18px;
            line-height: 50px;
            overflow: hidden;
            .iconfont {
                font-size: 26px;
                position: absolute;
                margin-top: -2px;
            }
            .text {
                margin-left: 30px;
            }
        }
        .el-menu {
            background: #1D8CE0 !important;
            display: inline-block;
            float: right;
        }
        .el-submenu-item.is-active,
        .el-menu-item:hover,
        .el-submenu.is-active .el-submenu__title,
        .el-submenu:hover .el-submenu__title {
            border-bottom: none !important;
            color: #fff !important;
            background: none !important;
        }
        .el-menu-item {
            margin: 10px 0 !important;
            height: 30px !important;
            line-height: 30px !important;
            border-bottom: none !important;
            border-radius: 2px;
            color: #D3DCE6;
            &.is-active {
                color: #fff;
            }
        }
    }
</style>