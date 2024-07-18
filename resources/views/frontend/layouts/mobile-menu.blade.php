@php
  // Fetching all categories with their subcategories and child categories with only active status (1)
  $categories = \App\Models\Category::where('status', 1)
      ->with([
          'subcategories' => function ($query) {
              $query->where('status', 1)->with([
                  'childCategories' => function ($query) {
                      $query->where('status', 1);
                  },
              ]);
          },
      ])
      ->get();
@endphp

<section id="wsus__mobile_menu">
  <span class="wsus__mobile_menu_close"><i class="fal fa-times"></i></span>
  <ul class="wsus__mobile_menu_header_icon d-inline-flex">

    <li><a href="wishlist.html"><i class="far fa-heart"></i>
        <span>2</span></a></li>

    <li><a href="compare.html"><i class="far fa-random"></i>
        </i><span>3</span></a></li>
  </ul>
  <form>
    <input type="text" placeholder="Search">
    <button type="submit"><i class="far fa-search"></i></button>
  </form>

  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
        data-bs-target="#pills-home" role="tab" aria-controls="pills-home"
        aria-selected="true">Categories</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
        data-bs-target="#pills-profile" role="tab"
        aria-controls="pills-profile" aria-selected="false">main
        menu</button>
    </li>
  </ul>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
      aria-labelledby="pills-home-tab">
      <div class="wsus__mobile_menu_main_menu">
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <ul class="wsus_mobile_menu_category">
            @foreach ($categories as $categoryIndex => $categoryItem)
              <li>
                <a href="#"
                  class="{{ count($categoryItem->subcategories) > 0 ? 'accordion-button' : '' }} collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#flush-collapseThreew-{{ $categoryIndex }}"
                  aria-expanded="false"
                  aria-controls="flush-collapseThreew-{{ $categoryIndex }}">
                  <i class="{{ $categoryItem->icon }}"></i>
                  {{ $categoryItem->name }}
                </a>
                @if (count($categoryItem->subcategories) > 0)
                  <div id="flush-collapseThreew-{{ $categoryIndex }}"
                    class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body" id="accordionFlushExample-2">
                      <ul>
                        @foreach ($categoryItem->subcategories as $subcategoryIndex => $subcategoryItem)
                          <li>
                            <a href="#"
                              class="{{ count($subcategoryItem->childCategories) > 0 ? 'accordion-button' : '' }} collapsed"
                              data-bs-toggle="collapse"
                              data-bs-target="#flush-collapseChildren-{{ $categoryIndex }}-{{ $subcategoryIndex }}"
                              aria-expanded="false"
                              aria-controls="flush-collapseChildren-{{ $categoryIndex }}-{{ $subcategoryIndex }}">
                              {{ $subcategoryItem->name }}
                            </a>
                            @if (count($subcategoryItem->childCategories) > 0)
                              <div
                                id="flush-collapseChildren-{{ $categoryIndex }}-{{ $subcategoryIndex }}"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample-2">
                                <div class="accordion-body-level-2">
                                  <ul>
                                    @foreach ($subcategoryItem->childCategories as $childCategoryIndex => $childCategoryItem)
                                      <li>
                                        <a
                                          href="#">{{ $childCategoryItem->name }}</a>
                                      </li>
                                    @endforeach
                                  </ul>
                                </div>
                              </div>
                            @endif
                          </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                @endif
              </li>
            @endforeach
          </ul>
        </div>
      </div>

    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
      aria-labelledby="pills-profile-tab">
      <div class="wsus__mobile_menu_main_menu">
        <div class="accordion accordion-flush" id="accordionFlushExample2">
          <ul>
            <li><a href="index.html">home</a></li>
            <li><a href="#" class="accordion-button collapsed"
                data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                aria-expanded="false"
                aria-controls="flush-collapseThree">shop</a>
              <div id="flush-collapseThree" class="accordion-collapse collapse"
                data-bs-parent="#accordionFlushExample2">
                <div class="accordion-body">
                  <ul>
                    <li><a href="#">men's</a></li>
                    <li><a href="#">wemen's</a></li>
                    <li><a href="#">kid's</a></li>
                    <li><a href="#">others</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li><a href="vendor.html">vendor</a></li>
            <li><a href="blog.html">blog</a></li>
            <li><a href="daily_deals.html">campain</a></li>
            <li><a href="#" class="accordion-button collapsed"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseThree101" aria-expanded="false"
                aria-controls="flush-collapseThree101">pages</a>
              <div id="flush-collapseThree101"
                class="accordion-collapse collapse"
                data-bs-parent="#accordionFlushExample2">
                <div class="accordion-body">
                  <ul>
                    <li><a href="404.html">404</a></li>
                    <li><a href="faqs.html">faq</a></li>
                    <li><a href="invoice.html">invoice</a></li>
                    <li><a href="about_us.html">about</a></li>
                    <li><a href="team.html">team</a></li>
                    <li><a href="product_grid_view.html">product grid
                        view</a></li>
                    <li><a href="product_grid_view.html">product list
                        view</a></li>
                    <li><a href="team_details.html">team details</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li><a href="track_order.html">track order</a></li>
            <li><a href="daily_deals.html">daily deals</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
