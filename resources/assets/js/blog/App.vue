<template>
    <div class="wrapper">
        <v-header></v-header>
        <main>
            <div class="main-container">
                <el-row :gutter="20">
                    <el-col :span="16">
                        <router-view></router-view>
                    </el-col>
                    <el-col :span="8" class="sidebar">
                        <v-sidebar></v-sidebar>
                    </el-col>
                </el-row>
            </div>
        </main>
        <v-footer
            :github="globals.github">
        </v-footer>
    </div>
</template>

<script>
    import VHeader from './components/partials/Header'
    import VFooter from './components/partials/Footer'
    import VSidebar from './components/partials/Sidebar'
    export default {
        data() {
            return {
                globals: []
            }
        },
        components: {
            VHeader, VFooter, VSidebar
        },
        http: {
            root: '/api'
        },
        created() {
            var vm = this
            this.$http.get('init')
                .then((response) => {
                    this.globals = response.data
                })
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
    }
    .wrapper {
        position: relative;
    }
    main {
        font-size: 14px;
        padding: 10px 5px;
    }
    .main-container {
        margin: 0 auto;
        width: 1050px;
        background: #fff;
    }
</style>