<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="" onerror='onImgError(this);' class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p></p>
          <a href="/#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">어드민 화면</li>
        
        <li class="treeview">
          <a href="/#"><i class="fa fa-link"></i> <span>채팅관리</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/chata?status=all">채팅목록</a></li>
            <li><a href="/chata?status=request">채팅신청목록</a></li>
            <li><a href="/aaaa">신고목록</a></li>
            <li><a href="/clientq">고객문의목록</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="/#"><i class="fa fa-link"></i> <span>관리자설정</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/aaaa">관리자관리</a></li>
            <li><a href="/aaaa">기본설정</a></li>
            <li><a href="/usera">회원관리</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="/#"><i class="fa fa-link"></i> <span>결제관리</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/pay?page=stats">결제통계</a></li>
            <li><a href="/pay">결제목록</a></li>
            <li><a href="/aaaa">무통장신청</a></li>
          </ul>
        </li>        
        
        <li class="treeview">
          <a href="/#"><i class="fa fa-link"></i> <span>문의관리</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/aaaa">파트너가입</a></li>
            <li><a href="/aaaa">수익금정산</a></li>
            <li><a href="/aaaa">인트로/배너/링크설정</a></li>
            <li><a href="/aaaa">게시판문의</a></li>
            <li><a href="/aaaa">출금신청</a></li>
            <li><a href="/aaaa">신용카드/휴대폰결제/무통장입금</a></li>
            <li><a href="/aaaa">SMS인증</a></li>
            <li><a href="/aaaa">파트너 시스템 연동</a></li>
            <li><a href="/aaaa">수익금현황</a></li>
            <li><a href="/aaaa">수익금통계</a></li>
          </ul>
        </li>     
        
        <li class="treeview">
          <a href="/#"><i class="fa fa-link"></i> <span>통계관리</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/aaaa">일별접속통계</a></li>
            <li><a href="/aaaa">접속경로분석</a></li>
            <li><a href="/aaaa">포인트LOG</a></li>
          </ul>
        </li>                   
        
        <li class="active"><a href="/sht.chatlist({status: 'all'})"><i class="fa fa-link"></i> <span>Chat List</span></a></li>
        <li><a href="/#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Your Page Content Here -->
			<!-- ?php include_once(APPPATH.'views/cm/app/includes/notifications.php'); ?-->

			<!-- BEGIN MAIN CONTENT -->

