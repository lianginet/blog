<template>
    <div class="content">
        <el-table :data="articles" border style="width: 100%">
            <el-table-column prop="id" label="ID"></el-table-column>
            <el-table-column prop="title" label="标题"></el-table-column>
            <el-table-column prop="category" label="分类"></el-table-column>
            <el-table-column prop="tags" label="标签"></el-table-column>
            <el-table-column prop="status" label="文章状态"></el-table-column>
            <el-table-column prop="created_at" label="创建日期"></el-table-column>
            <el-table-column prop="published_at" label="发布日期"></el-table-column>
            <el-table-column prop="updated_at" label="更新日期"></el-table-column>
        </el-table>
    </div>
</template>

<script type=text/ecmascript-6>
    export default {
        data() {
            return {
                tableData: [
                    {
                        date: '2016-05-02',
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1518 弄'
                    },
                    {
                        date: '2016-05-04',
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1517 弄'
                    },
                    {
                        date: '2016-05-01',
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1519 弄'
                    },
                    {
                        date: '2016-05-03',
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1516 弄'
                    }
                ]
            }
        }
    }
</script>

<style lang=scss scoped>

</style>