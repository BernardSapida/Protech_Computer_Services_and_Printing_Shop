<?php include_once "includes/clientPageRestriction.inc.php" ?>
<?php include_once "includes/account.inc.php" ?>
<?php include_once "includes/password.inc.php" ?>

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
                                <form class="account-validation forms" @submit.prevent="submitAccountForm" action="" method="POST" enctype="multipart/form-data" novalidate>
                                    <div class="card-body media align-items-center row">
                                        <div class="col-auto">
                                            <img :src="picture" id="profile_picture" alt="profile picture" class="d-block ui-w-80 rounded-circle">
                                        </div>
                                        <div class="media-body ml-4 col-auto" v-if="isEditAccount">
                                            <label class="btn btn-outline-primary">
                                                Upload new photo
                                                <input type="file" class="account-settings-fileinput" name="picture" id="picture" @change="validatePicture" required>
                                            </label> &nbsp;
                                            <p class="text-secondary mt-1 fs-6">Allowed .jpg, .jpeg, or png.</p>
                                        </div>
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 mb-3">
                                                <label class="form-label" for="firstname">Firstname</label>
                                                <input type="text" :class="[
                                                        {'is-valid': validFirstname},
                                                        {'is-invalid': !validFirstname && isAccountSubmitted},
                                                        'form-control'
                                                    ]" v-model="firstname" name="firstname" id="firstname" @keyup="validateFirstname" placeholder="Firstname" required />
                                                <div class="invalid-feedback" v-if="!validFirstname">{{errFirstname}}</div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 mb-3">
                                                <label class="form-label" for="lastname">Lastname</label>
                                                <input type="text" :class="[
                                                        {'is-valid': validLastname},
                                                        {'is-invalid': !validLastname && isAccountSubmitted},
                                                        'form-control'
                                                    ]" v-model="lastname" name="lastname" id="lastname" @keyup="validateLastname" placeholder="Lastname" required />
                                                <div class="invalid-feedback" v-if="!validLastname">{{errLastname}}</div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email address</label>
                                            <input type="email" :class="[
                                                    {'is-valid': validEmail},
                                                    {'is-invalid': !validEmail && isAccountSubmitted},
                                                    'form-control'
                                                ]" v-model="email" name="email" id="email" @keyup="validateEmail" placeholder="Email address" required />
                                            <div class="invalid-feedback" v-if="!validEmail">{{errEmail}}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="address">Address</label>
                                            <input type="text" :class="[
                                                    {'is-valid': validAddress},
                                                    {'is-invalid': !validAddress && isAccountSubmitted},
                                                    'form-control'
                                                ]" v-model="address" name="address" id="address" @keyup="validateAddress" placeholder="Address" required />
                                            <div class="invalid-feedback" v-if="!validAddress">{{errAddress}}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="contact">Contact Number</label>
                                            <input type="text" :class="[
                                                    {'is-valid': validContact},
                                                    {'is-invalid': !validContact && isAccountSubmitted},
                                                    'form-control'
                                                ]" v-model="contact" name="contact" id="contact" @keyup="validateContact" placeholder="Contact Number" required />
                                            <div class="invalid-feedback" v-if="!validContact">{{errContact}}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 mb-3">
                                                <label class="form-label" for="gcashName">Gcash Name</label>
                                                <input type="text" :class="[
                                                        {'is-valid': validGcashName},
                                                        {'is-invalid': !validGcashName && isAccountSubmitted},
                                                        'form-control'
                                                    ]" v-model="gcashName" name="gcashName" id="gcashName" @keyup="validateGcashName" placeholder="Gcash Name" required />
                                                <div class="invalid-feedback" v-if="!validGcashName">{{errGcashName}}</div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 mb-3">
                                                <label class="form-label" for="gcashNumber">Gcash Number</label>
                                                <input type="text" :class="[
                                                        {'is-valid': validGcashNumber},
                                                        {'is-invalid': !validGcashNumber && isAccountSubmitted},
                                                        'form-control'
                                                    ]" v-model="gcashNumber" name="gcashNumber" id="gcashNumber" @keyup="validateGcashNumber" placeholder="Gcash Number" required />
                                                <div class="invalid-feedback" v-if="!validGcashNumber">{{errGcashNumber}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="me-3 mb-3 d-flex gap-2" v-if="!isEditAccount" @click="editAccount">
                                        <button type="button" class="btn btn-dark ms-auto"><i class="fa-solid fa-pen-to-square"></i> Edit Account</button>
                                    </div>
                                    <div class="me-3 mb-3 d-flex gap-2" v-else>
                                        <button type="button" class="btn btn-outline-danger ms-auto" @click="cancelEditAccount"><i class="fa-solid fa-xmark"></i> Cancel</button>
                                        <button type="submit" class="btn btn-primary" id="submitAccount" name="submitAccount"><i class="fa-solid fa-floppy-disk"></i> Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div :class="['tab-pane', 'fade', {'show': isChangePassword}, {'active': isChangePassword}]">
                            <div class="p-3">
                                <h3>Change Password</h3>
                                <hr>
                                <form class="password-validation forms" @submit.prevent="submitPasswordForm" method="POST" action="" novalidate>
                                    <div class="mb-3">
                                        <label class="form-label" for="currentPassword">Current password</label>
                                        <input type="password" :class="[
                                                {'is-valid': validCurrentPassword},
                                                {'is-invalid': !validCurrentPassword && isPasswordSubmitted},
                                                'form-control'
                                            ]" v-model="currentPassword" name="currentPassword" id="currentPassword" @keyup="validateCurrentPassword" placeholder="Current password" required>
                                        <div class="invalid-feedback" v-if="!validCurrentPassword">{{errCurrentPassword}}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="newPassword">New password</label>
                                        <input type="password" :class="[
                                                {'is-valid': validNewPassword},
                                                {'is-invalid': !validNewPassword && isPasswordSubmitted},
                                                'form-control'
                                            ]" v-model="newPassword" name="newPassword" id="newPassword" @keyup="validateNewPassword" placeholder="New password" required>
                                        <div class="invalid-feedback" v-if="!validNewPassword">{{errNewPassword}}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="confirmPassword">Confirm password</label>
                                        <input type="password" :class="[
                                                {'is-valid': validConfirmPassword},
                                                {'is-invalid': !validConfirmPassword && isPasswordSubmitted},
                                                'form-control'
                                            ]" v-model="confirmPassword" name="confirmPassword" id="confirmPassword" @keyup="validateConfirmPassword" placeholder="Confirm password" required>
                                        <div class="invalid-feedback" v-if="!validConfirmPassword">{{errConfirmPassword}}</div>
                                    </div>
                                    <div class="me-3 mb-3 d-flex gap-2" v-if="!isEditPassword">
                                        <button type="button" class="btn btn-dark ms-auto" @click="editPassword">Change password</button>
                                    </div>
                                    <div class="me-3 mb-3 d-flex gap-2" v-else>
                                        <button type="button" class="btn btn-outline-danger ms-auto" @click="cancelEditPassword"><i class="fa-solid fa-xmark"></i> Cancel</button>
                                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div :class="['tab-pane', 'fade', {'show': isDeleteAccount}, {'active': isDeleteAccount}]">
                            <div class="p-3">
                                <h3>Deletion of account</h3>
                                <hr>
                                <form class="deletion-validation forms" @submit.prevent="submitDeletionForm" method="POST" novalidate>
                                    <p>Hi, <strong>Bernard Sapida</strong></p>
                                    <p>You can delete your account. It means you can't recover or open your account when it's been deleted.</p>
                                    <div class="mb-3">
                                        <label class="form-label" for="reason"><strong>Why are you going to delete your account?</strong></label>
                                        <input type="text" :class="[
                                                {'is-valid': validReason},
                                                {'is-invalid': !validReason && isAccountDeletionSubmitted},
                                                'form-control'
                                            ]" v-model="reason" name="reason" id="reason" @keyup="validateReason" placeholder="Reason of account deletion" required>
                                        <div class="invalid-feedback" v-if="!validReason">{{errReason}}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password"><strong>To continue, please enter your password</strong></label>
                                        <input type="password" :class="[
                                                {'is-valid': validPassword},
                                                {'is-invalid': !validPassword && isAccountDeletionSubmitted},
                                                'form-control'
                                            ]" v-model="password" name="password" id="password" @keyup="validatePassword" placeholder="Password" required>
                                        <div class="invalid-feedback" v-if="!validPassword">{{errPassword}}</div>
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
    const {
        createApp
    } = Vue

    createApp({
        created() {
            this.getClientInformation();
        },
        data() {
            return {
                // My Account
                picture: "",
                firstname: "",
                lastname: "",
                email: "",
                address: "",
                contact: "",
                gcashName: "",
                gcashNumber: "",
                validFirstname: false,
                validLastname: false,
                validEmail: false,
                validAddress: false,
                validContact: false,
                validGcashName: false,
                validGcashNumber: false,
                errFirstname: "",
                errLastname: "",
                errEmail: "",
                errAddress: "",
                errContact: "",
                errGcashName: "",
                errGcashNumber: "",
                isAccountSubmitted: false,
                isMyAccount: true,
                isEditAccount: false,

                isChangePassword: false,
                isEditPassword: false,
                isPasswordSubmitted: false,
                currentPassword: "",
                newPassword: "",
                confirmPassword: "",
                validCurrentPassword: false,
                validNewPassword: false,
                validConfirmPassword: false,
                errCurrentPassword: "",
                errNewPassword: "",
                errConfirmPassword: "",

                isDeleteAccount: false,
                isAccountDeletionSubmitted: false,
                reason: "",
                password: "",
                validReason: false,
                validPassword: false,
                errReason: "",
                errPassword: "",
            }
        },
        methods: {
            // My Account
            cancelEditAccount() {
                const form = document.querySelector('.account-validation');
                document.getElementById("profile_picture").setAttribute("src", this.picture);
                form.classList.remove('was-validated');
                this.isEditAccount = false;
            },
            editAccount() {
                this.isEditAccount = true;
            },
            submitAccountForm() {
                const form = document.querySelector('.account-validation');
                const inputs = document.querySelectorAll('input');

                this.isAccountSubmitted = true;

                this.validateFirstname();
                this.validateLastname();
                this.validateEmail();
                this.validateAddress();
                this.validateContact();
                this.validateGcashName();
                this.validateGcashNumber();

                const {
                    firstname,
                    lastname,
                    email,
                    address,
                    contact,
                    gcashName,
                    gcashNumber,
                    validFirstname,
                    validLastname,
                    validEmail,
                    validAddress,
                    validContact,
                    validGcashName,
                    validGcashNumber
                } = this;

                if (validFirstname && validLastname && validEmail && validAddress && validContact && validGcashName && validGcashNumber && validAddress) {
                    swal({
                        title: "Successful",
                        text: "Account information is now updated",
                        icon: "success",
                        button: false,
                        timer: 2000
                    }).then(() => form.submit());
                }
            },
            validateFirstname() {
                const {
                    firstname
                } = this;

                if (this.isAccountSubmitted) {
                    if (firstname.length == 0) {
                        this.errFirstname = "Firstname is required";
                        this.validFirstname = false;
                    } else if (firstname.length < 2) {
                        this.errFirstname = "Firstname is too short";
                        this.validFirstname = false;
                    } else if (!/^[A-z]+$/.test(firstname)) {
                        this.errFirstname = "Firstname is invalid";
                        this.validFirstname = false;
                    } else this.validFirstname = true;
                }
            },
            validateLastname() {
                const {
                    lastname
                } = this;

                if (this.isAccountSubmitted) {
                    if (lastname.length == 0) {
                        this.errLastname = "Lastname is required";
                        this.validLastname = false;
                    } else if (lastname.length < 2) {
                        this.errLastname = "Lastname is too short";
                        this.validLastname = false;
                    } else if (!/^[A-z]+$/.test(lastname)) {
                        this.errLastname = "Lastname is invalid";
                        this.validLastname = false;
                    } else this.validLastname = true;
                }
            },
            validateEmail() {
                const {
                    email
                } = this;

                if (this.isAccountSubmitted) {
                    if (email.length == 0) {
                        this.errEmail = "Email is required";
                        this.validEmail = false;
                    } else if (!email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
                        this.errEmail = "Email is invalid";
                        this.validEmail = false;
                    } else this.validEmail = true;
                }
            },
            validateAddress() {
                const {
                    address
                } = this;

                if (this.isAccountSubmitted) {
                    if (address.length == 0) {
                        this.errAddress = "Address is required";
                        this.validAddress = false;
                    } else if (address.length < 5) {
                        this.errAddress = "Address is invalid";
                        this.validAddress = false;
                    } else this.validAddress = true;
                }
            },
            validateContact() {
                const {
                    contact
                } = this;
                if (this.isAccountSubmitted) {
                    if (contact.length == 0) {
                        this.errContact = "Contact is required";
                        this.validContact = false;
                    } else if (!/^(09)[0-9]{9}$/.test(contact) && !contact.length != 11) {
                        this.errContact = "Contact is invalid";
                        this.validContact = false;
                    } else this.validContact = true;
                }
            },
            validateGcashName() {
                const {
                    gcashName
                } = this;

                if (this.isAccountSubmitted) {
                    if (gcashName.length == 0) {
                        this.errGcashName = "Gcash name is required";
                        this.validGcashName = false;
                    } else if (gcashName.length < 5) {
                        this.errGcashName = "Gcash name is too short";
                        this.validGcashName = false;
                    } else if (!/^[A-z ]+$/.test(gcashName)) {
                        this.errGcashName = "Gcash name is invalid";
                        this.validGcashName = false;
                    } else this.validGcashName = true;
                }
            },
            validateGcashNumber() {
                const {
                    gcashNumber
                } = this;

                if (this.isAccountSubmitted) {
                    if (gcashNumber.length == 0) {
                        this.errGcashNumber = "Gcash number is required";
                        this.validGcashNumber = false;
                    } else if (!/^(09)[0-9]{9}$/.test(gcashNumber) && !contact.length != 11) {
                        this.errGcashNumber = "Gcash number is invalid";
                        this.validGcashNumber = false;
                    } else this.validGcashNumber = true;
                }
            },
            validatePicture() {
                const FILE_PICTURE = document.getElementById('picture').files[0];

                if (FILE_PICTURE["name"] != "") {
                    const FILE = FILE_PICTURE["name"].split(".");
                    const FILE_NAME = FILE[0];
                    const FILE_EXTERNAL = FILE[1];
                    const VALID_EXTERNAL = ["jpg", "jpeg", "png"];

                    if (VALID_EXTERNAL.indexOf(FILE_EXTERNAL) == -1) {
                        swal({
                            title: "Profile picture is invalid",
                            text: "Profile picture external should be .jpg, .jpeg, or .png",
                            icon: "error",
                            button: false,
                            timer: 2000
                        })
                        document.getElementById('picture').value = "";
                        return;
                    }

                    if (FILE_PICTURE) {
                        const fileReader = new FileReader();
                        fileReader.readAsDataURL(FILE_PICTURE);
                        fileReader.addEventListener("load", function() {
                            document.getElementById("profile_picture").setAttribute("src", this.result);
                        });
                    }
                }
            },

            // Load Client Information
            async getClientInformation() {
                let response = await axios({
                    method: 'GET',
                    url: 'includes/client_information.inc.php'
                });

                this.picture = "public/images/profile/" + response.data["image"];
                this.firstname = response.data["firstname"];
                this.lastname = response.data["lastname"];
                this.email = response.data["email"];
                this.address = response.data["address"];
                this.contact = response.data["contact_number"];
                this.gcashName = response.data["gcash_name"];
                this.gcashNumber = response.data["gcash_number"];
            },

            // Client password
            submitPasswordForm() {
                const form = document.querySelector('.password-validation');

                this.isPasswordSubmitted = true;

                this.validateCurrentPassword();
                this.validateNewPassword();
                this.validateConfirmPassword();

                const {
                    currentPassword,
                    newPassword,
                    confirmPassword,
                    validCurrentPassword,
                    validNewPassword,
                    validConfirmPassword
                } = this;

                if (validCurrentPassword && validNewPassword && validConfirmPassword) {
                    swal({
                        title: "Account successfully created!",
                        text: "You can now use your account to sign in",
                        icon: "success",
                        button: false,
                        timer: 2000
                    }).then((okay) => form.submit());
                }
            },
            cancelEditPassword() {
                const form = document.querySelector('.password-validation');
                form.classList.remove('was-validated');
                form.reset();
                this.isEditPassword = false;
            },
            editPassword() {
                this.isEditPassword = true;
            },
            async validateCurrentPassword() {
                const {
                    currentPassword
                } = this;

                if (this.isPasswordSubmitted) {
                    if (currentPassword.length == 0) {
                        this.errCurrentPassword = "Current password is required";
                        this.validCurrentPassword = false;
                        return;
                    }

                    let response = await axios({
                        method: 'POST',
                        url: 'includes/verifyPassword.inc.php',
                        data: {
                            password: currentPassword,
                        }
                    });

                    if (response.data != "password matched") {
                        this.errCurrentPassword = "Current password is invalid!";
                        this.validCurrentPassword = false;
                    } else this.validCurrentPassword = true;
                }
            },
            validateNewPassword() {
                const {
                    newPassword
                } = this;

                this.validateConfirmPassword();

                if (this.isPasswordSubmitted) {
                    if (newPassword.length == 0) {
                        this.errNewPassword = "New password is required";
                        this.validNewPassword = false;
                    } else if (newPassword.length < 8) {
                        this.errNewPassword = "New password length must be greater than 8 characters";
                        this.validNewPassword = false;
                    } else this.validNewPassword = true;
                }
            },
            validateConfirmPassword() {
                const {
                    newPassword,
                    confirmPassword
                } = this;

                if (this.isPasswordSubmitted) {
                    if (confirmPassword.length == 0) {
                        this.errConfirmPassword = "Confirm password is required";
                        this.validConfirmPassword = false;
                    } else if (newPassword != confirmPassword) {
                        this.errConfirmPassword = "Confirm password didn't match to password";
                        this.validConfirmPassword = false;
                    } else this.validConfirmPassword = true;
                }
            },

            // Client Delete Account
            submitDeletionForm() {
                const form = document.querySelector('.deletion-validation');

                this.isAccountDeletionSubmitted = true;

                this.validateReason();
                this.validatePassword();

                const {
                    reason,
                    password,
                    validReason,
                    validPassword
                } = this;

                if (validReason && validPassword) {
                    swal({
                        title: "Account successfully deleted!",
                        text: "You are redirecting to our signin page",
                        icon: "success",
                        button: false,
                        timer: 2000
                    }).then(async () => {
                        let response = await axios({
                            method: 'POST',
                            url: 'includes/account_deletion.inc.php',
                            data: {
                                reason: reason,
                                password: password,
                            }
                        });

                        window.location.href = "index.php?page=signout";
                    });
                }
            },
            validateReason() {
                const {
                    reason
                } = this;

                if (this.isAccountDeletionSubmitted) {
                    if (reason.length == 0) {
                        this.errReason = "Reason is required";
                        this.validReason = false;
                    } else if (reason.length < 10) {
                        this.errReason = "Reason is too short";
                        this.validReason = false;
                    } else this.validReason = true;
                }
            },
            async validatePassword() {
                const {
                    password
                } = this;

                if (this.isAccountDeletionSubmitted) {
                    if (password.length == 0) {
                        this.errPassword = "Password is required";
                        this.validPassword = false;
                        return;
                    }

                    let response = await axios({
                        method: 'POST',
                        url: 'includes/verifyPassword.inc.php',
                        data: {
                            password: password,
                        }
                    });

                    if (response.data != "password matched") {
                        this.errPassword = "Password is invalid!";
                        this.validPassword = false;
                    } else this.validPassword = true;
                }
            },
            redirectLink(link) {
                const forms = document.querySelectorAll('.forms');
                forms.forEach(form => {
                    form.classList.remove('was-validated');
                    form.reset();
                });

                this.isMyAccount = this.isChangePassword = this.isDeleteAccount = false;

                if (link === "My Account") this.isMyAccount = true;
                if (link === "Change Password") this.isChangePassword = true;
                if (link === "Delete Account") this.isDeleteAccount = true;
            },
        }
    }).mount('#app')
</script>