<template>
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Adviser Adding Form</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form class="form-label-left input_mask">

                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" placeholder="First Name">
                                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <input type="text" class="form-control" id="lastName" placeholder="Last Name">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <input type="email" class="form-control has-feedback-left" id="email" placeholder="Email">
                                    <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <input type="tel" class="form-control" id="mobileNumber" placeholder="Mobile Number">
                                    <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <input type="email" class="form-control has-feedback-left" id="birthday" placeholder="Birthday">
                                    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <select class="form-control" id="gender">
                                        <option disabled value = "" selected>Choose option</option>
                                        <option>Female</option>
                                        <option>Male</option>
                                    </select>
                                    <span class="fa fa-mars form-control-feedback right" aria-hidden="true"></span>
                                </div>


                                <br><br>
                                <div class="ln_solid"></div>
                                <div class="form-group row">
                                    <div class="col-md-9 col-sm-9  offset-md-3">
                                        <button type="button" class="btn btn-primary">Cancel</button>
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
