<template>
    <div class="sidebar">
        <el-menu :default-active="$route.path" router class="sidebar-menu">
            <el-menu-item index="/articles"><i class="iconfont icon-book"></i> 文章管理</el-menu-item>
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
            .el-submenu .el-menu-item {
                height: auto;
                line-height: 45px;
                padding: 0 10px 0 40px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                & > i {
                    position: relative;
                    margin-top: 2px;
                }
            }
            .el-menu-item.is-active {
                background: #d3dce6;
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