@extends('app')
@section('title', __('messages.cookies_policy'))
@section('header', __('messages.cookies_policy_header'))
@include('cookies.cookies-' . app()->getLocale())