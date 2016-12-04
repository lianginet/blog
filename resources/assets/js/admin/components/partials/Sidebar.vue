<template>
    <div class="sidebar">
        <el-menu default-active="1-1" class="sidebar-menu">
            <el-submenu index="1">
                <template slot="title">
                    <i class="iconfont icon-dashboard"></i>
                    <span>Dashboard</span>
                </template>
                <el-menu-item index="1-1">数据报表</el-menu-item>
            </el-submenu>
            <el-submenu index="22">
                <template slot="title">
                    <i class="iconfont icon-setting"></i>
                    <span>系统管理</span>
                </template>
                <el-menu-item index="22-1">管理员管理</el-menu-item>
            </el-submenu>
            <el-submenu index="2">
                <template slot="title">
                    <i class="iconfont icon-book"></i>
                    <span>笔记管理</span>
                </template>
                <el-menu-item index="2-1">笔记列表</el-menu-item>
                <el-menu-item index="2-2">添加笔记</el-menu-item>
            </el-submenu>
        </el-menu>
    </div>
</template>

<script>
</script>

<style lang=scss>
    .sidebar {
        width: 255px;
        height: 100%;
        overflow-x: hidden;
        overflow-y: scroll;
        .el-menu {
            background: none !important;
        }
        .sidebar-menu {
            width: 235px;
            padding-right: 20px;
            .el-menu-item-group__title {
                font-size: 12px;
                padding-left: 10px !important;
                padding-top: 0 !important;
                line-height: 32px;
            }
            .el-menu-item {
                height: auto;
                line-height: 45px;
                padding: 0 10px 0 40px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                &.is-active {
                    background: #d3dce6;
                }
            }
            .el-submenu .el-menu-item:hover, .el-submenu__title:hover {
                background: #e8edf3;
            }
        }
        .el-submenu__title {
            font-size: 15px;
            height: 50px;
            line-height: 50px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    }
</style>