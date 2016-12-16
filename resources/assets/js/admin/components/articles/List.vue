<template>
    <div class="content">
        <div class="operation">
            <el-button type="primary">添加文章</el-button>
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
            <el-table-column prop="title" label="标题" width="250"></el-table-column>
            <el-table-column prop="cid" label="分类" align="center"></el-table-column>
            <el-table-column prop="tags" label="标签" align="center"></el-table-column>
            <!--<el-table-column prop="status" label="文章状态" align="center" width="100"></el-table-column>-->
            <el-table-column prop="created_at" label="创建日期" align="center" width="180"></el-table-column>
            <el-table-column prop="updated_at" label="更新日期" align="center" width="180"></el-table-column>
            <el-table-column
                    inline-template
                    :context="_self"
                    fixed="right"
                    label="操作"
                    width="100">
                <span>
                    <el-button type="text" size="small" @click="handleShow(row.id)">查看</el-button>
                    <el-button type="text" size="small">编辑</el-button>
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
                }
            }
        },
        http: {
            root: '/api',
        },
        created() {
            this.getArticles(this.pagination.page, this.pagination.pageSize)
        },
        methods: {
            getArticles(page, pageSize) {
                console.log(page, pageSize)
                let vm = this
                this.$http.get('articles', {params: {page: page, size: pageSize}})
                        .then((response) => {
                            console.log('Get articles')
                            let result = response.data
                            vm.articles = result.data
                            // Set vm.pagination's params
                            let pagination = result.meta.pagination
                            vm.pagination.total = pagination.total
                            vm.currentPage = pagination.current_page
                            vm.pageSize = pagination.per_page
                        })
                        .catch((response) => {
                            console.log(response.data)
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
</style>