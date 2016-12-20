<template>
    <div class="content">
        <div class="operation">
            <router-link to="/articles/create"><el-button type="primary">添加文章</el-button></router-link>
            <el-form :inline="true" class="operation-form">
                <el-form-item>
                    <el-input placeholder="文章名称"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-select placeholder="分类">
                        <el-option label="区域一" value="shanghai"></el-option>
                        <el-option label="区域二" value="beijing"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item>
                    <el-button>查询</el-button>
                </el-form-item>
            </el-form>
        </div>
        <el-table :data="articles" border stripe max-height="500">
            <el-table-column prop="id" label="ID" width="80" align="center" fixed></el-table-column>
            <el-table-column label="标题" inline-template :context="_self" width="300">
                <span>
                    <router-link :to="{name:'showArticle', params: {aid: row.id}}" class="article-title"><el-button type="text">{{ row.title }}</el-button></router-link>
                </span>
            </el-table-column>
            <el-table-column prop="category" label="分类" width="120" align="center"></el-table-column>
            <el-table-column prop="tags" label="标签" width="150" align="center"></el-table-column>
            <!--<el-table-column prop="status" label="文章状态" align="center" width="100"></el-table-column>-->
            <el-table-column prop="create_time" label="创建日期" align="center"></el-table-column>
            <el-table-column prop="update_time" label="更新日期" align="center"></el-table-column>
            <el-table-column
                    inline-template
                    :context="_self"
                    fixed="right"
                    label="操作"
                    align="center"
                    width="100">
                <span style="text-align:center">
                    <router-link :to="{name:'editArticle', params: {aid: row.id}}"><el-button type="text" size="small">编辑</el-button></router-link>
                    <el-button type="text" size="small" @click="confirmDestory(row.id)">删除</el-button>
                </span>
            </el-table-column>
        </el-table>
        <el-pagination
                @size-change="handleSizeChange"
                @current-change="handleCurrentChange"
                :current-page="pagination.page"
                :page-sizes="[10, 15, 20]"
                :page-size="pagination.pageSize"
                layout="total, sizes, prev, pager, next, jumper"
                :total="pagination.total">
        </el-pagination>
        <el-dialog title="提示" v-model="destory.dialogVisible" size="tiny">
            <span>确定删除ID为 {{destory.aid}} 的文章吗？</span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="destory.dialogVisible = false">取 消</el-button>
                <el-button type="primary" @click="handleDestroy">确 定</el-button>
            </span>
        </el-dialog>
    </div>
</template>

<script type=text/ecmascript-6>
    export default {
        data() {
            return {
                articles: [],
                pagination: {
                    total: 0,
                    page: 1,
                    pageSize: 10,
                },
                destory: {
                    aid: 0,
                    dialogVisible: false
                },
            }
        },
        http: {
            root: '/api/articles',
        },
        created() {
            this.getArticles(this.pagination.page, this.pagination.pageSize)
        },
        methods: {
            logout() {
                window.localStorage.setItem('token', '')
                this.$router.push('/auth')
            },
            getArticles(page, pageSize) {
                console.log(page, pageSize)
                let vm = this
                this.$http.get('', {params: {page: page, size: pageSize, token: window.localStorage.token}})
                        .then((response) => {
                            if (response.data == -1) {
                                this.logout()
                                return false
                            }
                            console.log('Get articles')
                            let result = response.data
                            vm.articles = result.data

                            // Set vm.pagination's params
                            let pagination = result.meta.pagination
                            console.log(pagination)

                            vm.pagination.total = pagination.total
                            vm.page = pagination.current_page
                            vm.pageSize = pagination.per_page
                        })
                        .catch((error) => {
                            console.log(error)
                        })
            },
            handleSizeChange(pageSize) {
                this.pagination.pageSize = pageSize
                this.getArticles(1, pageSize)
            },
            handleCurrentChange(page) {
                this.getArticles(page, this.pagination.pageSize)
            },
            handleShow(id) {
                console.log(id)
            },
            confirmDestory(aid) {
                this.destory.aid = aid
                this.destory.dialogVisible = true
            },
            handleDestroy() {
                let vm = this
                this.$http.delete(this.destory.aid.toString(), {params: {token: window.localStorage.token}})
                        .then((response) => {
                            vm.destory.dialogVisible = false
                            if (response.data.stat !== true) {
                                vm.$message({
                                    message: '成功删除id为 ' + vm.destory.aid + '的文章',
                                    type: 'success',
                                })
                            } else {
                                vm.$message({
                                    message: '文章删除失败！',
                                    type: 'error'
                                })
                            }
                        })
                        .catch((error) => {
                            console.log(error)
                        })
            }
        }
    }
</script>

<style lang=scss scoped>
    .operation {
        margin-top: 20px;
        .operation-form {
            float: right;
        }
    }
    .el-table {
        width: 100%;
    }
    .el-pagination {
        margin-top: 10px;
    }
    .article-title {
        color: #555;
        text-decoration: none;
    }
</style>

<style lang=scss>
    .el-message__group p {
        position: absolute;
        font-size: 13px;
        margin-top: 1px;
    }
</style>