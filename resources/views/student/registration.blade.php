@extends('layouts.student')

@section('content')
<!-- page content -->
        <div class="right_col" role="main">

          <div class="row">

          <div class="col-md-5 col-sm-5 ">
              <div class="x_panel tile fixed_height_400">
                <div class="x_title">
                  <h2>Registrations</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Settings 1</a>
                          <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

    <br>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Student Type *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select name="" id=""  class="form-control" >
                                        <option :value=null>Select Student Type</option>
                                        <option>Old Student</option>
                                        <option>Transferee</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Level *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select name="" id=""  class="form-control" >
                                        <option :value=null>Select Level</option>
                                        <option>Old Student</option>
                                        <option>Transferee</option>
                                    </select>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group row">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <button type="submit" class="btn btn-info">Show Subjects</button>
                                </div>
                            </div>
                    
                </div>
              </div>
            </div>
            

          <div class="col-md-4 col-sm-4 ">
              <div class="x_panel tile fixed_height_400">
                <div class="x_title">
                  <h2>Subjects</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Settings 1</a>
                          <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  
                <div class="">
                        <ul class="to_do">
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> English </p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Math</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Science</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Filipino</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> History</p>
                          </li>
                        </ul>
                      </div>
                    
                      <div class="ln_solid"></div>
                            <div class="form-group row">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </div>
                </div>
              </div>
            </div>



            <div class="col-md-3 col-sm-3 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Guides</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Settings 1</a>
                          <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                <a>INSTRUCTION</a>
                            </h2>
                            <div class="byline">
                            </div>
                            <p class="excerpt">
                                After submitting your registration in this app, proceed to registrars office and submit all the requirements. This registration will expire within 5 working days.
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                REQUIREMENTS
                            </h2>
                            <div class="byline">
                              <span>Transferee</span>
                            </div>
                            <p class="excerpt">
                                - Form 137 <br>
                                - Good moral <br>
                                - PSA Birth Certificate
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                AGREEMENTS
                            </h2>
                            <div class="byline">
                            </div>
                            <p class="excerpt">
                            Riusmod tempor incididunt ut labor erem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            


          </div>
        </div>
        </div>

        <!-- /page content -->
@endsection
