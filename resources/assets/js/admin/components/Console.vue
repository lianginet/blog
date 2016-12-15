<template>
    <div class="wrapper">
        <div class="view-nav">
            <div class="nav-container">
                <v-header></v-header>
            </div>
        </div>
        <div class="view-sidebar">
            <div class="sidebar-container">
                <v-sidebar></v-sidebar>
            </div>
        </div>
        <div class="view-content">
            <div class="content-container">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    import VHeader from './partials/Header'
    import VSidebar from './partials/Sidebar'

    export default {
        components: {
            VHeader,
            VSidebar
        }
    }
</script>

<style lang=scss>
    html, body {
        margin: 0;
        padding: 0;
        font-family: Helvetica Neue,Helvetica,PingFang SC,Hiragino Sans GB,Microsoft YaHei,SimSun,sans-serif;
        color: #555;
        line-height: 1.5;
        height: 100%;
    }
    .wrapper {
        position: relative;
        height: 100%;
        width: 100%;
        overflow: hidden;
    }
    .view-nav {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 50px;
        line-height: 50px;
        border-bottom: 1px solid #eee;
        .nav-container {
            padding: 0 10px;
            background: #f8f8f8;
        }
    }
    .view-sidebar {
        position: absolute;
        top: 51px;
        left: 0;
        bottom: 0;
        width: 235px;
        .sidebar-container {
            position: relative;
            z-index: 1;
            height: 100%;
            overflow: hidden;
            background: #f8f8f8;
            border-right: 1px solid #eee;
        }
    }
    .view-content {
        position: absolute;
        top: 51px;
        left: 236px;
        bottom: 0;
        right: 0;
        .content-container {
            height: 100%;
            overflow: auto;
            padding: 20px;
        }
    }
</style>