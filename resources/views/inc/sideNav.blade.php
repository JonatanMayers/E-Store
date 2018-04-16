<?php
$currentUrl = Request::path();
?>

<div class="list-group">

    <a class="list-group-item {{ $currentUrl=="admin" ? "active" : "" }}"
       href="/admin">Home</a>
    <a class="list-group-item {{ $currentUrl=="admin/categories" ? "active" : "" }}"
       href="{{ route("categories.index") }}">All categories</a>
    <a class="list-group-item {{ $currentUrl=="admin/categories/create" ? "active" : "" }}"
       href="{{ route("categories.create") }}">Create category</a>
    <a class="list-group-item {{ $currentUrl=="admin/brands" ? "active" : "" }}"
       href="{{ route("brands.index") }}">All brands</a>
    <a class="list-group-item {{ $currentUrl=="admin/brands/create" ? "active" : "" }}"
       href="{{ route("brands.create") }}">Create brand</a>
    <a class="list-group-item {{ $currentUrl=="admin/conditions" ? "active" : "" }}"
       href="{{ route("conditions.index") }}">All conditions</a>
    <a class="list-group-item {{ $currentUrl=="admin/conditions/create" ? "active" : "" }}"
       href="{{ route("conditions.create") }}">Create condition</a>
    <a class="list-group-item {{ $currentUrl=="admin/products" ? "active" : "" }}"
       href="{{ route("products.index") }}">All products</a>
    <a class="list-group-item {{ $currentUrl=="admin/products/create" ? "active" : "" }}"
       href="{{ route("products.create") }}">Create product</a>
    <a class="list-group-item {{ $currentUrl=="admin/comments" ? "active" : "" }}"
       href="{{ route("comments.index") }}">All comments</a>
    <a class="list-group-item {{ $currentUrl=="admin/photos" ? "active" : "" }}"
       href="{{ route("photos.index") }}">All photos</a>

    @if(auth()->user()->is_admin)
        <a class="list-group-item {{ $currentUrl=="admin/users" ? "active" : "" }}"
           href="{{ route("users.index") }}">All users</a>
        <a class="list-group-item {{ $currentUrl=="admin/users/create" ? "active" : "" }}"
           href="{{ route("users.create") }}">Create new user</a>
        <a class="list-group-item {{ $currentUrl=="admin/users/profile" ? "active" : "" }}"
           href="{{ route("users.profile") }}">My profile</a>
        <a class="list-group-item {{ $currentUrl=="admin/settings" ? "active" : "" }}"
           href="{{ route("settings.edit") }}">Settings</a>
    @else
        <a class="list-group-item {{ $currentUrl=="admin/users/profile" ? "active" : "" }}"
           href="{{ route("users.profile") }}">My profile</a>
    @endif


</div>