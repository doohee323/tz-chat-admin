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
        <li class="header">Admin Page</li>
        
        <li class="treeview">
          <a href="/#"><i class="fa fa-link"></i> <span>Chatting Manage</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/chata?status=all">Chatting List</a></li>
            <li><a href="/chata?status=request">Chatting Request List</a></li>
            <li><a href="/clientq">Client Q&A List</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="/#"><i class="fa fa-link"></i> <span>Manage자설정</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/aaaa">Manager Manage</a></li>
            <li><a href="/usera">회원Manage</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="/#"><i class="fa fa-link"></i> <span>Pay Manage</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/pay?page=stats">Pay Stats</a></li>
            <li><a href="/pay">Pay List</a></li>
            <li><a href="/aaaa">무통장Request </a></li>
          </ul>
        </li>        
        
        <li class="treeview">
          <a href="/#"><i class="fa fa-link"></i> <span>문의Manage</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/aaaa">파트너가입</a></li>
            <li><a href="/aaaa">수익금정산</a></li>
            <li><a href="/aaaa">인트로/배너/링크설정</a></li>
            <li><a href="/aaaa">게시판문의</a></li>
            <li><a href="/aaaa">출금Request </a></li>
            <li><a href="/aaaa">신용카드/휴대폰Pay /무통장입금</a></li>
            <li><a href="/aaaa">SMS인증</a></li>
            <li><a href="/aaaa">파트너 시스템 연동</a></li>
            <li><a href="/aaaa">수익금현황</a></li>
            <li><a href="/aaaa">수익금Stats</a></li>
          </ul>
        </li>     
        
        <li class="treeview">
          <a href="/#"><i class="fa fa-link"></i> <span>StatsManage</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/aaaa">일별접속Stats</a></li>
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

