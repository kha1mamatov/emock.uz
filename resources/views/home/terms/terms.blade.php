@extends('app')
@section('title', __('messages.terms_of_service'))
@section('header', __('messages.terms_of_service_header'))
@include('terms.terms-' . app()->getLocale())