<section class="my-5" id="app">
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">Account settings</h4>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a :class="['list-group-item', 'list-group-item-action', {'active': isMyAccount}]" @click="redirectLink('My Account')" href="#">My Account</a>
                        <a :class="['list-group-item', 'list-group-item-action', {'active': isChangePassword}]" @click="redirectLink('Change Password')" href="#">Change password</a>
                        <a :class="['list-group-item', 'list-group-item-action', {'active': isDeleteAccount}]" @click="redirectLink('Delete Account')" href="#">Delete Account</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div :class="['tab-pane', 'fade', {'show': isMyAccount}, {'active': isMyAccount}]">
                            <div class="p-3">
                                <h3>My Account</h3>
                                <hr>
                                <form class="account-validation forms" @submit.prevent="submitAccountForm" novalidate>
                                    <div class="card-body media align-items-center row">
                                        <div class="col-auto">
                                            <img src="public/images/profile/developer.jpg" alt="" class="d-block ui-w-80 rounded">
                                        </div>
                                        <div class="media-body ml-4 col-auto">
                                            <label class="btn btn-outline-primary">
                                                Upload new photo
                                                <input type="file" class="account-settings-fileinput">
                                            </label> &nbsp;
                                            <p class="text-secondary mt-1 fs-6">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                        </div>
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="firstname">Firstname</label>
                                            <input type="text" class="form-control" name="firstname" id="firstname" value="Bernard" required>
                                            <div class="invalid-feedback">Firstname is required</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="lastname">Lastname</label>
                                            <input type="text" class="form-control" name="lastname" id="lastname" value="Sapida" required>
                                            <div class="invalid-feedback">Lastname is required</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="">Email</label>
                                            <input type="text" class="form-control mb-1" value="bernardsapida1706@gmail.com" required>
                                            <div class="invalid-feedback">Email is required</div>
                                        </div>
                                    </div>
                                    <div class="me-3 mb-3 d-flex gap-2">
                                        <button type="button" class="btn btn-outline-dark ms-auto">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div :class="['tab-pane', 'fade', {'show': isChangePassword}, {'active': isChangePassword}]">
                            <div class="p-3">
                                <h3>Change Password</h3>
                                <hr>
                                <form class="password-validation forms" @submit.prevent="submitPasswordForm" novalidate>
                                    <div class="mb-3">
                                        <label class="form-label" for="currentPassword">Current password</label>
                                        <input type="password" class="form-control" name="currentPassword" id="currentPassword" required>
                                        <div class="invalid-feedback">Current password is required</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="newPassword">New password</label>
                                        <input type="password" class="form-control" name="newPassword" id="newPassword" required>
                                        <div class="invalid-feedback">New password is required</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="repeatPassword">Confirm password</label>
                                        <input type="password" class="form-control" name="repeatPassword" id="repeatPassword" required>
                                        <div class="invalid-feedback">Confirm password is required</div>
                                    </div>
                                    <div class="d-flex">
                                        <button class="btn btn-primary ms-auto">Change password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div :class="['tab-pane', 'fade', {'show': isDeleteAccount}, {'active': isDeleteAccount}]">
                            <div class="p-3">
                                <h3>Deletion of account</h3>
                                <hr>
                                <form class="deletion-validation forms" @submit.prevent="submitDeletionForm" novalidate>
                                    <p>Hi, <strong>Bernard Sapida</strong></p>
                                    <p>You can delete your account. It means you can't recover or open your account when it's been deleted.</p>
                                    <div class="mb-3">
                                        <label class="form-label" for="deletion_reason"><strong>Why are you going to delete your account?</strong></label>
                                        <input type="text" class="form-control" name="deletion_reason" id="deletion_reason" placeholder="Reason of account deletion" required>
                                        <div class="invalid-feedback">Deletion reason is required</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password"><strong>To continue, please enter your password</strong></label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                        <div class="invalid-feedback">Password is required</div>
                                    </div>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-danger ms-auto">Delete account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const { createApp } = Vue

    createApp({
        data() {
            return {
                isMyAccount: true,
                isChangePassword: false,
                isDeleteAccount: false,
                email: "",
                password: "",
            }
        },
        methods: {
            submitAccountForm() {
                const form = document.querySelector('.account-validation');
                form.classList.add('was-validated');
            },
            submitPasswordForm() {
                const form = document.querySelector('.password-validation');
                form.classList.add('was-validated');
            },
            submitDeletionForm() {
                const form = document.querySelector('.deletion-validation');
                form.classList.add('was-validated');
            },
            redirectLink(link) {
                const forms = document.querySelectorAll('.forms');
                forms.forEach(form => {
                    form.classList.remove('was-validated');
                    form.reset();   
                });

                this.isMyAccount = this.isChangePassword = this.isDeleteAccount = false;
               
                if(link === "My Account") this.isMyAccount = true;
                if(link === "Change Password") this.isChangePassword = true;
                if(link === "Delete Account") this.isDeleteAccount = true; 
            }
        }
    }).mount('#app')
</script>