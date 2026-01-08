@extends('errors::minimal')

@section('title', __('Interdit'))
@section('code', '403')
@section('code-title', '403 - Interdit')
@section('message', __($exception->getMessage() ?: 'Interdit'))
