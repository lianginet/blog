<template>
    <section>
        <span class="title">Search</span>
        <el-form :inline="true" class="demo-form-inline">
            <el-form-item class="search-input">
                <el-input placeholder="Search"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="default" icon="search"></el-button>
            </el-form-item>
        </el-form>
        <div class="search-result">
            这里显示搜索结果
        </div>
    </section>
</template>

<style lang=scss scoped>
    .el-form-item {
        margin-bottom: 0;
        margin-right: 0 !important;
    }
    .search-input {
        width: 84.8%;
    }
    .search-result {
        line-height: 2;
        font-size: 13px;
    }
</style>