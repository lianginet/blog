<template>
    <section v-if="$route.name =='wiki' || $route.name == 'index'">
        <span class="title">Wiki</span>
        <el-card class="box-card">
            <div v-for="o in 4" class="card-item">
                {{'维基标题 ' + o }}
            </div>
        </el-card>
    </section>
</template>

<style lang=scss>

</style>