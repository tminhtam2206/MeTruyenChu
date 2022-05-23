@extends('layouts.forum')
@section('title', $baidang->title)
@section('content')
<div class="page-inner">
    <div class="container">
        <div class="page-section">
            <div class="section-block">
                <div class="feed">
                    <div class="feed-post card">
                        <div class="card-header card-header-fluid">
                            <a href="#" class="btn-account" role="button">
                                <div class="user-avatar user-avatar-lg">
                                    <img src="{{ getAvatar($baidang->User->avatar) }}" alt="">
                                </div>
                                <div class="account-summary">
                                    <p class="account-name">{{ $baidang->title }}</p>
                                    <p class="account-description">{{ $baidang->created_at->diffForHumans() }}</p>
                                </div>
                            </a>
                            <div class="dropdown align-self-start ml-auto">
                                <button class="btn btn-icon btn-light text-muted"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>{!! $baidang->content !!}</p>
                            <div class="feed-summary">
                                <a href="#" class="feed-summary-item mr-auto">
                                    <div class="avatar-group mr-2">
                                        <figure class="user-avatar user-avatar-xs">
                                            <img src="assets/images/avatars/uifaces5.jpg" alt="">
                                        </figure>
                                        <figure class="user-avatar user-avatar-xs">
                                            <img src="assets/images/avatars/uifaces6.jpg" alt="">
                                        </figure>
                                        <figure class="user-avatar user-avatar-xs">
                                            <img src="assets/images/avatars/uifaces7.jpg" alt="">
                                        </figure>
                                    </div>6.3K likes
                                </a>
                                <a href="#" class="feed-summary-item">{{ $baidang->comments }} bình luận</a>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="card-footer-item">
                                <button type="button" class="btn btn-reset text-nowrap text-muted"><i class="fa fa-fw fa-heart"></i> Thích</button>
                            </div>
                            <div class="card-footer-item">
                                <button type="button" class="btn btn-reset text-nowrap text-muted"><i class="fa fa-fw fa-comment"></i> Bình luận</button>
                            </div>
                        </div>
                    </div>
                    <div class="feed-comments card">
                        <div class="card-header d-flex justify-content-between">
                            <a href="#">View more comments</a><span class="text-muted">72 of 826</span>
                        </div>
                        <div role="log" class="conversations">
                            <ul class="conversation-list">
                                <li class="conversation-action mt-3">
                                    <div class="media">
                                        <figure class="user-avatar mr-2">
                                            <img src="{{ getAvatar(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                        </figure>
                                        <div class="media-body">
                                            <div class="publisher publisher-alt">
                                                <div class="publisher-input">
                                                    <textarea name="pcPublisherInput" class="form-control" placeholder="Bình luận của bạn..."></textarea>
                                                </div>
                                                <div class="publisher-actions">
                                                    <div class="publisher-tools mr-auto">
                                                        <div class="btn btn-light btn-icon fileinput-button">
                                                            <i class="fa fa-paperclip"></i><input type="file" id="pc-attachment" name="pcAttachment[]" multiple>
                                                        </div><button type="button" class="btn btn-light btn-icon"><i class="far fa-smile"></i></button>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Đăng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="conversation-inbound">
                                    <div class="conversation-avatar">
                                        <a href="#" class="user-avatar"><img src="assets/images/avatars/profile.jpg" alt=""></a>
                                    </div>
                                    <div class="conversation-message">
                                        <div class="conversation-meta">
                                            <a href="#"><strong>Beni arisandi</strong></a><span class="mention ml-1">Author</span><small class="time ml-1">1hr</small>
                                        </div>
                                        <div class="conversation-message-text">Quaerat eum quia ad, obcaecati ex placeat autem, molestiae iusto ab ipsum eius dicta dolores corporis debitis quasi! Neque, modi impedit iusto!</div>
                                        <div class="conversation-meta">
                                            <a href="#">Thích</a> · <a href="#">Trả lời</a> · <a href="#">Chỉnh sửa</a> · <a href="#">Xóa</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="conversation-inbound">
                                    <div class="conversation-avatar">
                                        <a href="#" class="tile tile-circle bg-muted"><i class="oi oi-person"></i></a>
                                    </div>
                                    <div class="conversation-message">
                                        <div class="conversation-meta">
                                            <a href="#"><strong>Diane Peters</strong></a><small class="time ml-1">32m</small>
                                        </div>
                                        <div class="conversation-message-text">Consectetur quis veritatis aut maiores omnis, expedita officiis delectus perspiciatis a dolores.</div>
                                        <div class="conversation-meta">
                                            <a href="#">Like</a> · <a href="#">Reply</a> · <a href="#">Edit</a> · <a href="#">Delete</a>
                                        </div>
                                        <ul class="conversation-list">
                                            <li class="conversation-inbound">
                                                <div class="conversation-message">
                                                    <div class="conversation-meta">
                                                        <a href="#"><i class="fa fa-reply fa-rotate-180"></i></a><a href="#" class="user-avatar user-avatar-xs mx-1"><img src="assets/images/avatars/uifaces16.jpg" alt=""></a><a href="#">Betty Simmons · 5 Replies</a> · 12m
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="conversation-inbound">
                                    <div class="conversation-avatar">
                                        <a href="#" class="user-avatar"><img src="assets/images/avatars/uifaces11.jpg" alt=""></a>
                                    </div>
                                    <div class="conversation-message">
                                        <div class="conversation-meta">
                                            <a href="#"><strong>Jennifer Gray</strong></a><small class="time ml-1">Edited 14m</small>
                                        </div>
                                        <div class="conversation-message-text">Officiis numquam, repellat nam tempore sit aliquid nostrum autem excepturi quis nihil.</div>
                                        <div class="conversation-meta">
                                            <a href="#">Like</a> · <a href="#">Reply</a> · <a href="#">Edit</a> · <a href="#">Delete</a>
                                        </div>
                                        <ul class="conversation-list">
                                            <li class="conversation-inbound">
                                                <div class="conversation-avatar">
                                                    <a href="#" class="user-avatar user-avatar-sm"><img src="assets/images/avatars/uifaces15.jpg" alt=""></a>
                                                </div>
                                                <div class="conversation-message">
                                                    <div class="conversation-meta">
                                                        <a href="#"><strong>Russell Gilbert</strong></a><small class="time ml-1">4m</small>
                                                    </div>
                                                    <div class="conversation-message-text">Enim laborum, architecto molestias velit quod tempora!</div>
                                                    <div class="conversation-meta">
                                                        <a href="#">Like</a> · <a href="#">Reply</a> · <a href="#">Edit</a> · <a href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="conversation-inbound">
                                                <div class="conversation-avatar">
                                                    <a href="#" class="user-avatar user-avatar-sm"><img src="assets/images/avatars/profile.jpg" alt=""></a>
                                                </div>
                                                <div class="conversation-message">
                                                    <div class="conversation-meta">
                                                        <a href="#"><strong>Beni Arisandi</strong></a><span class="mention ml-1">Author</span><small class="time ml-1">Just now</small>
                                                    </div>
                                                    <div class="conversation-message-text">
                                                        <a href="#"><strong></strong></a> Adipisicing elit.
                                                    </div>
                                                    <div class="conversation-meta">
                                                        <a href="#">Like</a> · <a href="#">Reply</a> · <a href="#">Edit</a> · <a href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="conversation-action mt-3">
                                                <div class="media">
                                                    <figure class="user-avatar user-avatar-sm mt-1 mr-2">
                                                        <img src="assets/images/avatars/profile.jpg" alt="">
                                                    </figure>
                                                    <div class="media-body">
                                                        <div class="publisher publisher-alt">
                                                            <div class="publisher-input">
                                                                <textarea name="pcsPublisherInput" class="form-control" placeholder="Write a comment"></textarea>
                                                            </div>
                                                            <div class="publisher-actions">
                                                                <div class="publisher-tools mr-auto">
                                                                    <div class="btn btn-light btn-icon fileinput-button">
                                                                        <i class="fa fa-paperclip"></i><input type="file" id="pcs-attachment" name="pcsAttachment[]" multiple>
                                                                    </div><button type="button" class="btn btn-light btn-icon"><i class="far fa-smile"></i></button>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Publish</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="conversation-inbound">
                                    <div class="conversation-avatar">
                                        <a href="#" class="user-avatar"><img src="assets/images/avatars/uifaces12.jpg" alt=""></a>
                                    </div>
                                    <div class="conversation-message">
                                        <div class="conversation-meta">
                                            <a href="#"><strong>Zachary Fowler</strong></a><small class="time ml-1">5m</small>
                                        </div>
                                        <div class="conversation-message-text">Ad earum dolore excepturi itaque officia.</div>
                                        <div class="conversation-meta">
                                            <a href="#">Like</a> · <a href="#">Reply</a> · <a href="#">Edit</a> · <a href="#">Delete</a>
                                        </div>
                                        <ul class="conversation-list">
                                            <li class="conversation-inbound">
                                                <div class="conversation-message">
                                                    <div class="conversation-meta">
                                                        <a href="#"><i class="fa fa-reply fa-rotate-180"></i></a><a href="#">View 8 Replies</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection