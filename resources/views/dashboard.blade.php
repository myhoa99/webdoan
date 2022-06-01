@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">pending_actions</i>
            </div>
            <p class="card-category">Pending</p>
            <h3 class="card-title">{{ $pendingRecipes }}
              <small>{{ $pendingRecipes == 0 || $pendingRecipes == 1  ? 'Recipe' : 'Recipes' }}</small>
            </h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <a href="/recipes/pending">View all...</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">done</i>
            </div>
            <p class="card-category">Approved</p>
            <h3 class="card-title">{{ $approvedRecipes }}
              <small>{{ $approvedRecipes == 0 || $approvedRecipes == 1  ? 'Recipe' : 'Recipes' }}</small>
            </h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <a href="/recipes/approved">View all...</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-danger card-header-icon">
            <div class="card-icon">
              <i class="material-icons">clear</i>
            </div>
            <p class="card-category">Disapproved</p>
            <h3 class="card-title">{{ $disapprovedRecipes }}
              <small>{{ $disapprovedRecipes == 0 || $disapprovedRecipes == 1  ? 'Recipe' : 'Recipes' }}</small>
            </h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <a href="/recipes/disapproved">View all...</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">content_paste</i>
            </div>
            <p class="card-category">Recipes</p>
            <h3 class="card-title">{{ $recipes }}
            </h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <a href="/recipes/all">View all...</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">supervisor_account</i>
            </div>
            <p class="card-category">Users</p>
            <h3 class="card-title">{{ $users }}</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <a href="/users">View all...</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">list</i>
            </div>
            <p class="card-category">Categories</p>
            <h3 class="card-title">{{ $categories }}</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <a href="/categories/all">View all...</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">public</i>
            </div>
            <p class="card-category">Cuisines</p>
            <h3 class="card-title">{{ $cuisines }}</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <a href="/cuisines/all">View all...</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    

    <div class="row">
      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title">Most Liked Recipes</h4>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-hover">
              <thead class="text-warning">
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Likes</th>
              </thead>
              <tbody>
                @foreach ($topFiveRecipes as $i => $recipe)
                <tr>
                  <th>{{ $i + 1 }}</th>
                  <td><img style="border-radius: 50%;" width="50" height="50" src="/uploads/recipes/{{ $recipe->image }}" /></td>
                  <td>{{ $recipe->name }}</td>
                  <td style="text-align: center;">{{ $recipe->noOfLikes }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title">Most Active Users</h4>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-hover">
              <thead class="text-warning">
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Recipes</th>
              </thead>
              <tbody>
                @foreach ($mostActiveUsers as $i => $user)
                <tr>
                  <th>{{ $i + 1 }}</th>
                  @if ($user->image != null)
                  <td><img style="border-radius: 50%;" width="50" height="50" src="{{ str_contains($user->image, 'http') == true ? $user->image : '/uploads/users/'. $user->image  }}" /></td>
                  @else
                  <td><img style="border-radius: 50%;" width="50" height="50" src="/default/no_image_placeholder.jpg" alt="..."></td>
                  @endif
                  <td>{{ $user->name }}</td>
                  <td style="text-align: center;">{{ $user->recipeCount }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
</div>
@endsection

@push('js')
<script>
  $(document).ready(function() {
    // Javascript method's body can be found in assets/js/demos.js
    md.initDashboardPageCharts();
  });
</script>
@endpush