<template>
    <section v-if="$route.name == 'tags' || $route.name == 'index'">
        <span class="title">Tags</span>
        <el-card class="box-card">
            <div v-for="o in 4" class="card-item">
                {{'标签标题 ' + o }}
            </div>
        </el-card>
    </section>
</template>

<style lang=scss>

</style>