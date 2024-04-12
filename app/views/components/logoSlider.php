<div class="brands-slider">
    <div class="marquee">
        <ul class="marquee-content">
            <li>
                <img src="/wholesale/public/img/logos/logo1.svg" alt="">
            </li>
            <li>
                <img src="/wholesale/public/img/logos/logo2.svg" alt="">

            </li>
            <li>
                <img src="/wholesale/public/img/logos/logo3.svg" alt="">

            </li>
            <li>
                <img src="/wholesale/public/img/logos/logo4.svg" alt="">

            </li>
            <li>
                <img src="/wholesale/public/img/logos/logo5.svg" alt="">

            </li>
            <li>
                <img src="/wholesale/public/img/logos/logo6.svg" alt="">

            </li>
            <li>
                <img src="/wholesale/public/img/logos/logo2.svg" alt="">

            </li>
            <li>
                <img src="/wholesale/public/img/logos/logo3.svg" alt="">

            </li>
            <li>
                <img src="/wholesale/public/img/logos/logo4.svg" alt="">

            </li>
            <li>
                <img src="/wholesale/public/img/logos/logo5.svg" alt="">

            </li>
            <li>
                <img src="/wholesale/public/img/logos/logo6.svg" alt="">

            </li>
        </ul>

    </div>
</div>


<script>
    const root = document.documentElement;
    const marqueeElementsDisplayed = getComputedStyle(root).getPropertyValue("--marquee-elements-displayed");
    const marqueeContent = document.querySelector("ul.marquee-content");

    root.style.setProperty("--marquee-elements", marqueeContent.children.length);

    for (let i = 0; i < marqueeElementsDisplayed; i++) {
        marqueeContent.appendChild(marqueeContent.children[i].cloneNode(true));
    }
</script>