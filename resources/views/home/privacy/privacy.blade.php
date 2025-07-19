@extends('app')
@section('title', __('messages.privacy_policy'))
@section('header', __('messages.privacy_policy_header'))
@include('privacy.privacy-' . app()->getLocale())