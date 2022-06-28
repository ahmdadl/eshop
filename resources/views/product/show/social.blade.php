<div class="row pt-3">
    <div class="col-12 text-center">
        <ul class="nav text-center justify-content-center">
            <li aria-label="Facebook" class="nav-item">
                <a class="nav-link btn btn-outline-primary mx-2" target="_blank"
                    href="https://www.facebook.com/sharer.php?u={{url()->current()}}">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </li>
            <li aria-label="Share" class="nav-item">
                <a class="nav-link btn btn-outline-primary mx-2" target="_blank"
                    href="https://twitter.com/intent/tweet?url={{url()->current()}}&text={{__('t.show.shareTxt') . $p->name}}">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
            <li aria-label="LinkedIn" class="nav-item">
                <a class="nav-link btn btn-outline-primary mx-2" target="_blank"
                    href="https://www.linkedin.com/shareArticle?mini=true&url={{url()->current()}}&title={{__('t.show.shareTxt') . $p->name}}">
                    <i class="fab fa-linkedin"></i>
                </a>
            </li>
        </ul>
    </div>
</div>