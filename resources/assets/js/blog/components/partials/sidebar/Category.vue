<template>
    <section v-if="$route.name == 'categories' || $route.name == 'index'">
        <span class="title">Categories</span>
        <el-card class="box-card">
            <div v-for="o in 4" class="card-item">
                {{'分类标题 ' + o }}
            </div>
        </el-card>
    </section>
</template>

<style lang=scss>

</style>