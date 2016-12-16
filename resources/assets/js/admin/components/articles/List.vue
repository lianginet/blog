<template>
    <div class="content">
        <el-table :data="articles" border max-height="500">
            <el-table-column prop="id" label="ID" width="80" align="center" fixed></el-table-column>
            <el-table-column prop="title" label="标题" width="250"></el-table-column>
            <el-table-column prop="cid" label="分类" align="center"></el-table-column>
            <el-table-column prop="tags" label="标签" align="center"></el-table-column>
            <el-table-column prop="status" label="文章状态" align="center" width="100"></el-table-column>
            <el-table-column prop="created_at" label="创建日期" align="center" width="180"></el-table-column>
            <el-table-column prop="published_at" label="发布日期" align="center" width="180"></el-table-column>
            <el-table-column prop="updated_at" label="更新日期" align="center" width="180"></el-table-column>
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
            }
        }
    }
</script>

<style lang=scss scoped>
    .el-table {
        width: 100%;
    }
    .el-pagination {
        margin-top: 10px;
    }
</style>