<!DOCTYPE html>
<html lang="en">

<head>
  <title>Resume/CV {{$user->name}}</title>

  <!-- Meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Resume/CV {{$user->name}}">
  <link rel="shortcut icon" href="favicon.ico">

  <style>
    body {
      font-family: "Roboto", sans-serif;
      color: #545E6C;
      background: #fff;
      font-size: 14px;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-weight: 700;
    }

    a {
      color: #f47c03;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
      color: #a85502;
      -webkit-transition: all 0.4s ease-in-out;
      -moz-transition: all 0.4s ease-in-out;
      -ms-transition: all 0.4s ease-in-out;
      -o-transition: all 0.4s ease-in-out;
    }

    a:focus {
      text-decoration: none;
    }

    p {
      line-height: 1.5;
    }

    .wrapper {
      background: #FDA246;
      max-width: 960px;
      margin: 0 auto;
      position: relative;
      -webkit-box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
      -moz-box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .sidebar-wrapper {
      background: #FDA246;
      position: absolute;
      right: 0;
      width: 240px;
      font-weight: bold;
      /*height: 100%;*/
      /*min-height: 800px;*/
      color: #fff;
    }

    .sidebar-wrapper a {
      color: #fff;
    }

    .sidebar-wrapper .profile-container {
      padding: 30px;
      background: rgba(0, 0, 0, 0.2);
      text-align: center;
      color: #fff;
    }

    .sidebar-wrapper .name {
      font-size: 32px;
      font-weight: 900;
      margin-top: 0;
      margin-bottom: 10px;
    }

    .sidebar-wrapper .tagline {
      color: #fff;
      font-size: 16px;
      font-weight: 400;
      margin-top: 0;
      margin-bottom: 0;
    }

    .sidebar-wrapper .profile {
      margin-bottom: 15px;
    }

    .sidebar-wrapper .contact-list .svg-inline--fa {
      margin-right: 5px;
      font-size: 18px;
      vertical-align: middle;
    }

    .sidebar-wrapper .contact-list li {
      margin-bottom: 15px;
    }

    .sidebar-wrapper .contact-list li:last-child {
      margin-bottom: 0;
    }

    .sidebar-wrapper .contact-list .email .svg-inline--fa {
      font-size: 14px;
    }

    .sidebar-wrapper .container-block {
      padding: 30px;
    }

    .sidebar-wrapper .container-block-title {
      text-transform: uppercase;
      font-size: 16px;
      font-weight: 700;
      margin-top: 0;
      margin-bottom: 15px;
    }

    .sidebar-wrapper .degree {
      font-size: 14px;
      margin-top: 0;
      margin-bottom: 5px;
    }

    .sidebar-wrapper .education-container .item {
      margin-bottom: 15px;
    }

    .sidebar-wrapper .education-container .item:last-child {
      margin-bottom: 0;
    }

    .sidebar-wrapper .education-container .meta {
      color: #fff;
      font-weight: 500;
      margin-bottom: 0px;
      margin-top: 0;
      font-size: 14px;
    }

    .sidebar-wrapper .education-container .time {
      color: rgb(99, 99, 99);
      font-weight: 500;
      margin-bottom: 0px;
    }

    .sidebar-wrapper .languages-container .lang-desc {
      color: #fff;
    }

    .sidebar-wrapper .languages-list {
      margin-bottom: 0;
    }

    .sidebar-wrapper .languages-list li {
      margin-bottom: 10px;
    }

    .sidebar-wrapper .languages-list li:last-child {
      margin-bottom: 0;
    }

    .sidebar-wrapper .interests-list {
      margin-bottom: 0;
    }

    .sidebar-wrapper .interests-list li {
      margin-bottom: 10px;
    }

    .sidebar-wrapper .interests-list li:last-child {
      margin-bottom: 0;
    }

    .main-wrapper {
      background: #fff;
      padding: 60px;
      padding-right: 300px;
    }

    .main-wrapper .section-title {
      text-transform: uppercase;
      font-size: 20px;
      font-weight: 500;
      color: #f47c03;
      position: relative;
      margin-top: 0;
      margin-bottom: 20px;
    }

    .main-wrapper .section-title .icon-holder {
      width: 30px;
      height: 30px;
      margin-right: 8px;
      display: inline-block;
      color: #fff;
      -webkit-border-radius: 50%;
      -moz-border-radius: 50%;
      -ms-border-radius: 50%;
      -o-border-radius: 50%;
      border-radius: 50%;
      -moz-background-clip: padding;
      -webkit-background-clip: padding-box;
      background-clip: padding-box;
      background: #f47c03;
      text-align: center;
      font-size: 16px;
      position: relative;
      top: -2px;
      padding-top: 2px;
    }

    .main-wrapper .section-title .icon-holder .svg-inline--fa {
      font-size: 14px;
      margin-top: 6px;
    }

    .main-wrapper .section {
      margin-bottom: 60px;
    }

    .main-wrapper .experiences-section .item {
      margin-bottom: 30px;
    }

    .main-wrapper .upper-row {
      position: relative;
      overflow: hidden;
      margin-bottom: 2px;
    }

    .main-wrapper .job-title {
      color: #3F4650;
      font-size: 16px;
      margin-top: 0;
      margin-bottom: 0;
      font-weight: 500;
    }

    .main-wrapper .time {
      position: absolute;
      right: 0;
      top: 0;
      color: rgb(99, 99, 99);
    }

    .main-wrapper .company {
      margin-bottom: 10px;
      color: #fff;
    }

    .main-wrapper .project-title {
      font-size: 16px;
      font-weight: 400;
      margin-top: 0;
      margin-bottom: 5px;
    }

    .main-wrapper .projects-section .intro {
      margin-bottom: 30px;
    }

    .main-wrapper .projects-section .item {
      margin-bottom: 15px;
    }

    .skillset .item {
      margin-bottom: 15px;
      overflow: hidden;
    }

    .skillset .level-title {
      font-size: 14px;
      margin-top: 0;
      margin-bottom: 12px;
    }

    .skillset .level-bar {
      height: 12px;
      background: #f5f5f5;
      -webkit-border-radius: 2px;
      -moz-border-radius: 2px;
      -ms-border-radius: 2px;
      -o-border-radius: 2px;
      border-radius: 2px;
      -moz-background-clip: padding;
      -webkit-background-clip: padding-box;
      background-clip: padding-box;
    }

    .skillset .theme-progress-bar {
      background: #febb78;
    }

    @media (max-width: 767.98px) {
      .sidebar-wrapper {
        position: static;
        width: inherit;
      }

      .main-wrapper {
        padding: 30px;
      }

      .main-wrapper .time {
        position: static;
        display: block;
        margin-top: 5px;
      }

      .main-wrapper .upper-row {
        margin-bottom: 0;
      }
    }

    @media (min-width: 992px) {
      .skillset .level-title {
        display: inline-block;
        float: left;
        width: 30%;
        margin-bottom: 0;
      }
    }

    .page_break {
      page-break-before: always;
    }
  </style>
</head>

<body>
  <div class="wrapper " style="margin-top:50px">

    <div class="sidebar-wrapper">

      <div class="profile-container">
        @if($user->printCustomUserImage())
        <img class="profile" style="border-radius: 100%" width="150px" src="{{$user->printCustomUserImage()}}" alt="" />
        @endif
        <h1 class="name">{{$user->name}}</h1>
        <h3 class="tagline"> 
        
        <!--{{$user->getCareerLevel('career_level')}} --->
        
        {{$user->getFunctionalArea('functional_area')}}
        </h3>
        <!--<h3 class="tagline"> {{$user->getIndustry('industry')}}</h3>-->
      </div>
      <!--//profile-container-->

      <div class="">
        <ul class="list-unstyled contact-list">
          <li class="">Email: {{$user->email}}</li>
          <li class="">Documento : {{$user->national_id_card_number}}</a></li>
          <li class="">Contacto : {{$user->mobile_num}}</a></li>
          <!--<li class="website"><a href="https://themes.3rdwavemedia.com/bootstrap-templates/resume/orbit-free-resume-cv-bootstrap-theme-for-developers/" target="_blank">portfoliosite.com</a></li>-->
          <!--<li class="linkedin"><a href="#" target="_blank">linkedin.com/in/alandoe</a></li>-->
          <!--<li class="github"><a href="#" target="_blank">github.com/username</a></li>-->
          <!--<li class="twitter"><a href="https://twitter.com/3rdwave_themes" target="_blank">@twittername</a></li>-->
        </ul>
      </div>
      <!--//contact-container-->




    </div>
    <!--//sidebar-wrapper-->

    <div class="main-wrapper">

      <section class="section summary-section" style="margin-top:70px">
        <h2 class="section-title"><span class="icon-holder"><i class="fa-solid fa-user"></i></span>Acerca de mí</h2>
        <div class="summary">
          <p>{{$user->getProfileSummary('summary')}}</p>
        </div>
        <!--//summary-->
      </section>
      <!--//section-->


      <div class="page_break"></div>


      <section class="section experiences-section" style="margin-top:70px;  display:block">
        <h2 class="section-title"><span class="icon-holder"><i class="fa-solid fa-briefcase"></i></span>Educación</h2>

        @foreach($user->profileEducation as $item)
        <div class="item">
          <div class="meta">
            <div class="upper-row">
              <h3 class="job-title">Titulo : {{$item->degree_title}}</h3>
              <div class="time">Finalización : {{ $item->date_completion }} </div>
            </div>
            <!--//upper-row-->
            <div>Institución : {{$item->institution}}</div>
          </div>
          <!--//meta-->
        </div>
        <!--//item-->
        @endforeach

      </section>
      <!--//section-->


      <section class="section experiences-section">
        <h2 class="section-title"><span class="icon-holder"><i class="fa-solid fa-briefcase"></i></span>Experiencía</h2>

        @foreach($user->profileExperience as $item)
        <div class="item">
          <div class="meta">
            <div class="upper-row">
              <h3 class="job-title">Cargo : {{$item->title}}</h3>
              <div class="time">Tiempo laborado : {{ date("d-m-Y", strtotime($item->date_start)) }}  - {{ date("d-m-Y", strtotime($item->date_end)) }} </div>
            </div>
            <!--//upper-row-->
            <div>Compañia : {{$item->company}}</div>
          </div>
          <!--//meta-->
          <!--<div class="details">-->
          <p>Funciones : {{$item->description}}</p>
          <!--</div>-->
          <!--//details-->
        </div>
        <!--//item-->
        @endforeach

      </section>
      <!--//section-->

      <section class="section projects-section">
        <h2 class="section-title"><span class="icon-holder"><i class="fa-solid fa-archive"></i></span>Otras habilidades
        </h2>
        <!--<div class="intro">-->
        <!--    <p>You can list your side projects or open source libraries in this section. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et ligula in nunc bibendum fringilla a eu lectus.</p>-->
        <!--</div>-->

        <ul>

          @foreach($user->profileSkills as $item)
          <li>
            <div class="item">
              <span class="project-title"> {{$item->getJobSkill('job_skill')}} </span>
              <!--- <span class="project-tagline">{{$user->getJobExperience('job_experience')}}</span>-->
            </div>
            <!--//item-->
          </li>
          @endforeach
        </ul>
      </section>


      <section class="section projects-section">
        <h2 class="section-title"><span class="icon-holder"><i class="fa-solid fa-archive"></i></span>Idiomas
        </h2>
        <!--<div class="intro">-->
        <!--    <p>You can list your side projects or open source libraries in this section. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et ligula in nunc bibendum fringilla a eu lectus.</p>-->
        <!--</div>-->

        <ul>

          @foreach($user->profileLanguages as $item)
          <li>
            <div class="item">
              <span class="project-title"> Idioma : {{$item->getLanguage('lang')}} </span> - <span
                class="project-tagline"> Nivel : {{$item->getLanguageLevel('language_level')}}</span>
            </div>
            <!--//item-->
          </li>
          @endforeach
        </ul>
      </section>
      <!--//section-->

    </div>
    <!--//main-body-->
  </div>

</body>

</html>