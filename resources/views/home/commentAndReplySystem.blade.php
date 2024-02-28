<style type="text/css">
    a{
        /* color: rgb(1, 120, 231) !important; */
        /* background-color: red !important; */
        /* display: none; */
        /* display: none; */
    }
  </style>
<div style=" margin:1rem 0rem; display:flex; flex-direction:column; align-items:center; width:100%">

    <h1 style="font-size: 2rem;  margin: 1rem 0rem">
        Comments
    </h1>
    <form
    style="width: 100%; display:flex; flex-direction:column; align-items:center; "
    method="POST"
    action="{{url('add_comment')}}"
    >
        @csrf
        <textarea
        name="comment"
        style="width: 80%;"
        placeholder="enter your comments"></textarea>
        <br/>
        <div style="display:flex; align-items:center; justify-content:center;">

            <input
            type="submit"
            value="Comment"
            {{-- style="float: left" --}}
            class="btn btn-primary" />
        </div>
    </form>
    <div style="width: 100%; display:flex; justify-content:center; margin:2rem 0rem;">
        <div style="width: 80%; background-color: inherit; display:flex; flex-direction:column; gap:1rem; justify-content:flex-start; align-items:flex-start">

            @if (isset($comment))
            <h1>All comments</h1>
            @forelse ( $comment as $comment )
            <div>
                <b>{{$comment->name}}</b>
                <p>{{$comment->comment}}</p>

                @if (isset($reply))
                @foreach ( $reply as $rep )
                @if ($rep->comment_id == $comment->id)
                <div style="padding-left:20%; padding-top:1rem; ">
                    <b>{{$rep->name}}</b>
                    <p>{{$rep->reply}}</p>
                    {{-- <a
                    href="javascript::void(0);"
                    onclick="reply(this)"
                    data-Commentid="{{$comment->id}}"
                    >
                        Reply
                    </a> --}}
                </div>
                @endif
                @endforeach
                @endif
                <a
                href="javascript::void(0);"
                onclick="reply(this)"
                data-Commentid="{{$comment->id}}"
                >
                    Reply
                </a>
                {{-- for reply(this), other js and css, check the parent blade that imports/includes this blade i.e userpage.blade.php or something --}}

            </div>
            @empty
                <div>No comments yet</div>

            @endforelse
            @endif


            {{-- reply modeal --}}
            <div
            class="replyDiv"
            style="width: 100%; display:none;">
                <form
                action="{{url('/add_reply')}}"
                method="POST"
                style="width: 100%;">
                    @csrf
                    <input type="text" id="commentId" name="commentId"  hidden/>
                    {{-- the above inputs value is being set programatically because how do we get the value comment->id from a loop, it is only by passing it into a data attribute or likewise, and setting the value of this field to the data attribute value. simple --}}
                    <textarea
                    name="reply"
                    style="height:7rem; width: 40vw;"
                    {{-- style="height:7rem; width: 40vw;" --}}
                    placeholder="write something here"></textarea>
                    <br/>
                    <button
                    type="submit"
                    class="btn btn-primary"
                    style="color:black; background-color:skyblue;"
                    value="Reply"
                    >Reply</button>
                    <a
                    href="javascript::void(0);"
                    class="btn"
                    onclick="reply_close(this)"
                    >Close</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function reply(caller){
        document.getElementById('commentId').value = $(caller).attr('data-Commentid');
        $('.replyDiv').insertAfter( $(caller) );
        $('.replyDiv').show();
    }

    function reply_close(caller){
        // $('.replyDiv').insertAfter( $(caller) );
        $('.replyDiv').hide();
    }
</script>
