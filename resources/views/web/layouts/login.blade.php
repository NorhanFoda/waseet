<div class="modal fade" id="login-choose" tabindex="-1" role="dialog" aria-labelledby="login-choose"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h5 class="modal-title first_color">{{trans('web.login_as')}} : </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-right-dir">
            <div class="choose-login" data-aos="fade-in">

              @foreach($roles as $role)

                @if($role->name == 'student')
                  <div class="choose-login-link">
                    <a href="{{route('register.form', $role->id)}}"> <i class="fa fa-user-graduate"></i>{{trans('web.student')}}</a>
                  </div>
                @endif

                @if($role->name == 'direct_teacher')
                  <div class="choose-login-link">
                    <a href="{{route('register.form', $role->id)}}"><i class="fa fa-user"></i>{{trans('web.direct_teacher')}}</a>
                  </div>
                @endif

                @if($role->name == 'online_teacher')
                  <div class="choose-login-link">
                    <a href="{{route('register.form', $role->id)}}"><i class="fa fa-user"></i>{{trans('web.online_teacher')}}</a>
                  </div>
                @endif

                @if($role->name == 'organization')
                  <div class="choose-login-link">
                    <a href="{{route('register.form', $role->id)}}"><i class="fa fa-school"></i>{{trans('web.organization')}}</a>
                  </div>
                @endif

                @if($role->name == 'job_seeker')
                  <div class="choose-login-link">
                    <a href="{{route('register.form', $role->id)}}"><i class="fa  fa-search"></i> {{trans('web.job_seeker')}}</a>
                  </div>
                @endif

              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>