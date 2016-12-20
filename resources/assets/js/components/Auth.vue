<template>
    <div class="wrapper">
        <div class="auth-container">
            <el-form class="auth-form" :model="auth" ref="auth" :rules="authRules">
                <el-form-item class="from-desc">
                    <i class="iconfont icon-favicon"></i>
                    <span class="desc-text">Markdown notes -- Login</span>
                </el-form-item>
                <el-form-item prop="account">
                    <i class="iconfont icon-user form-icon"></i>
                    <el-input
                        v-model="auth.account"
                        placeholder="请输入账号"
                        type="text">
                    </el-input>
                </el-form-item>
                <el-form-item prop="password">
                    <i class="iconfont icon-lock form-icon"></i>
                    <el-input
                        v-model="auth.password"
                        placeholder="请输入账号"
                        type="password">
                    </el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="beforeSubmit">提交</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    export default {
        data() {
            return {
                auth: {
                    account: '',
                    password: '',
                },
                authRules: {
                    account: [
                        { required: true, message: '账号不能为空', trigger: 'blur' },
                        { min: 4, max: 12, message: '长度在 4 到 12 个字符', trigger: 'blur' }
                    ],
                    password: [
                        { required: true, message: '密码不能为空', trigger: 'blur' },
                        { min: 6, message: '长度不能小于 6 个字符', trigger: 'blur' }
                    ]
                }
            }
        },
        http: {
            root: '/api',
        },
        created() {
            window.localStorage.user = '';
        },
        methods: {
            beforeSubmit() {
                this.$refs.auth.validate((valid) => {
                    if (!valid) {
                        console.log('error submit!!');
                        return false;
                    } else {
                        this.submitLogin()
                    }
                });
            },
            submitLogin() {
                let vm = this
                this.$http.post('login', vm.auth)
                        .then((response) => {
                            console.log(response)
                            let data = response.data
                            console.log(data)
                            if (data == 0) {
                                window.localStorage.setItem('token', '')
                                vm.$message({
                                    message: '账号或密码错误',
                                    type: 'error',
                                    duration: 1000
                                })
                            }
                            if (data.admin) {
                                let storage = window.localStorage
                                storage.setItem('token', data.admin.token)
                                vm.$message({
                                    message: '登录成功',
                                    type: 'success',
                                    duration: 1000
                                })
                                setTimeout(() => {
                                    this.$router.push('/articles')
                                }, 1200)
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
    .auth-container {
        position: absolute;
        left: 50%;
        margin-left: -135px;
        width: 270px;
        color: #555;
        margin-top: 185px;
        .auth-form {
            .from-desc {
                .el-form-item__content {
                    font-size: 24px;
                }
            }
            .el-button--primary {
                width: 100%;
            }
            .form-icon {
                position: absolute;
                z-index: 2;
                color: #C0CCDA;
                margin-left: 12px;
            }
        }
    }
</style>
<style lang=scss>
    .auth-container {
        .el-input__inner {
            padding-left: 35px;
        }
        .el-form-item__error {
            padding-left: 2px;
        }
        .from-desc {
            .el-form-item__content {
                font-size: 20px;
                color: #888;
                .iconfont {
                    font-size: 24px;
                    position: absolute;
                    margin-left: 2px;
                }
                .desc-text {
                    margin-left: 30px;
                }
            }
        }
    }
</style>