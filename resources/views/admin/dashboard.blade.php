@extends('adminLayouts.home')
@section('content')

<div class="container-fluid px-3 px-md-4 py-4">

  <!-- ====================================================================
       DASHBOARD HERO BANNER
       ==================================================================== -->
  <div class="card border-0 mb-4" style="border-radius: 20px; background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);">
    <div class="card-body p-4">
      <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
        <div>
          <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="mb-0 fw-bold" style="font-family: 'Plus Jakarta Sans', sans-serif; color: #0f172a; font-size: 1.35rem;">
              Welcome back, {{ Auth::user()->name }} 👋
            </h4>
            <span class="badge rounded-pill" style="background: #fff1f2; color: #e11d48; border: 1px solid #fecdd3; font-weight: 700; font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.04em;">
              {{ str_replace('_', ' ', Auth::user()->type) }}
            </span>
          </div>
          <p class="text-muted mb-0" style="font-size: 0.88rem;">
            @if(Auth::user()->type == 'user')
              Track your customer ratings, QR stand scans, and feedback growth in real time.
            @elseif(Auth::user()->type == 'admin')
              Manage your active client stores, available credit balance, and user subscriptions.
            @else
              Global platform controls, reseller distribution, categories, and system templates.
            @endif
          </p>
        </div>

        <!-- Quick Action Buttons Header -->
        <div class="d-flex align-items-center gap-2 flex-wrap">
          @if(Auth::user()->type == 'user')
            <a href="{{ url('u/'.Auth::user()->name_url) }}" target="_blank" class="btn btn-sm d-flex align-items-center gap-2" style="background: #ffffff; color: #0f172a; border: 1.5px solid #cbd5e1; border-radius: 12px; font-weight: 700; padding: 9px 18px; transition: all 0.2s ease;">
              <i class="ti ti-external-link" style="color: #e11d48;"></i>
              <span>Live Portal</span>
            </a>
            <a href="{{ url('admin/view_qr') }}" class="btn btn-sm d-flex align-items-center gap-2" style="background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); color: #ffffff; border-radius: 12px; font-weight: 700; padding: 9px 18px; border: none; box-shadow: 0 4px 14px rgba(225, 29, 72, 0.28); transition: transform 0.2s ease;">
              <i class="ti ti-qrcode"></i>
              <span>QR Code Stand</span>
            </a>
          @elseif(Auth::user()->type == 'admin')
            <a href="{{ url('admin/add_sub_user_page') }}" class="btn btn-sm d-flex align-items-center gap-2" style="background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); color: #ffffff; border-radius: 12px; font-weight: 700; padding: 9px 18px; border: none; box-shadow: 0 4px 14px rgba(225, 29, 72, 0.28);">
              <i class="ti ti-user-plus"></i>
              <span>Add New User</span>
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>


  {{-- ====================================================================
       1. SUPER ADMIN DASHBOARD
       ==================================================================== --}}
  @if (Auth::user()->type == 'super_admin')
    
    <!-- KPI Row -->
    <div class="row g-3 mb-4">
      <div class="col-sm-6 col-xl-3">
        <div class="card border-0 h-100" style="border-radius: 18px; background: #ffffff; border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04); transition: transform 0.2s ease;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <span style="font-size: 0.85rem; font-weight: 700; color: #64748b;">Total Resellers</span>
              <div style="width: 44px; height: 44px; border-radius: 12px; background: #fff1f2; display: flex; align-items: center; justify-content: center; color: #e11d48; font-size: 1.3rem;">
                <i class="ti ti-users"></i>
              </div>
            </div>
            <div class="d-flex align-items-baseline justify-content-between">
              <h2 class="mb-0 fw-bold" style="color: #0f172a; font-size: 1.9rem;">{{ $resallers }}</h2>
              <span class="badge rounded-pill" style="background: #f1f5f9; color: #475569; font-weight: 700; font-size: 0.72rem;">All Time</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-xl-3">
        <div class="card border-0 h-100" style="border-radius: 18px; background: #ffffff; border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04); transition: transform 0.2s ease;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <span style="font-size: 0.85rem; font-weight: 700; color: #64748b;">Active Resellers</span>
              <div style="width: 44px; height: 44px; border-radius: 12px; background: #f0fdf4; display: flex; align-items: center; justify-content: center; color: #16a34a; font-size: 1.3rem;">
                <i class="ti ti-user-check"></i>
              </div>
            </div>
            <div class="d-flex align-items-baseline justify-content-between">
              <h2 class="mb-0 fw-bold" style="color: #16a34a; font-size: 1.9rem;">{{ $active_resallers }}</h2>
              <span class="badge rounded-pill" style="background: #dcfce7; color: #15803d; font-weight: 700; font-size: 0.72rem;">Active</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-xl-3">
        <div class="card border-0 h-100" style="border-radius: 18px; background: #ffffff; border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04); transition: transform 0.2s ease;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <span style="font-size: 0.85rem; font-weight: 700; color: #64748b;">Inactive Resellers</span>
              <div style="width: 44px; height: 44px; border-radius: 12px; background: #fffbeb; display: flex; align-items: center; justify-content: center; color: #d97706; font-size: 1.3rem;">
                <i class="ti ti-user-x"></i>
              </div>
            </div>
            <div class="d-flex align-items-baseline justify-content-between">
              <h2 class="mb-0 fw-bold" style="color: #d97706; font-size: 1.9rem;">{{ $inactive_resallers }}</h2>
              <span class="badge rounded-pill" style="background: #fef3c7; color: #b45309; font-weight: 700; font-size: 0.72rem;">Paused</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-xl-3">
        <div class="card border-0 h-100" style="border-radius: 18px; background: #ffffff; border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04); transition: transform 0.2s ease;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <span style="font-size: 0.85rem; font-weight: 700; color: #64748b;">Expired Accounts</span>
              <div style="width: 44px; height: 44px; border-radius: 12px; background: #fef2f2; display: flex; align-items: center; justify-content: center; color: #ef4444; font-size: 1.3rem;">
                <i class="ti ti-user-off"></i>
              </div>
            </div>
            <div class="d-flex align-items-baseline justify-content-between">
              <h2 class="mb-0 fw-bold" style="color: #ef4444; font-size: 1.9rem;">{{ $expired_resallers }}</h2>
              <span class="badge rounded-pill" style="background: #fee2e2; color: #b91c1c; font-weight: 700; font-size: 0.72rem;">Expired</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Resellers Card -->
    <div class="card border-0 mb-4" style="border-radius: 20px; border: 1px solid #e2e8f0 !important;">
      <div class="card-header bg-white d-flex align-items-center justify-content-between p-4" style="border-bottom: 1px solid #f1f5f9; border-radius: 20px 20px 0 0;">
        <h5 class="mb-0 fw-bold" style="color: #0f172a;"><i class="ti ti-users me-2 text-primary"></i>Recently Registered Resellers</h5>
        <a href="{{ url('admin/admin_list') }}" class="btn btn-sm btn-outline-primary" style="border-radius: 10px; font-weight: 700;">View All</a>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
            <thead class="table-light">
              <tr>
                <th class="ps-4">Reseller Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Expiry</th>
                <th class="pe-4 text-end">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($recent_resellers as $res)
                <tr>
                  <td class="ps-4 fw-bold text-dark">{{ $res->name }}</td>
                  <td>{{ $res->email }}</td>
                  <td>{{ $res->phone ?? '-' }}</td>
                  <td>
                    @if($res->status == 'active')
                      <span class="badge bg-success-subtle text-success fw-bold">Active</span>
                    @else
                      <span class="badge bg-danger-subtle text-danger fw-bold">Inactive</span>
                    @endif
                  </td>
                  <td>{{ date('d M Y', strtotime($res->expiry_date)) }}</td>
                  <td class="pe-4 text-end">
                    <a href="{{ url('admin/edit_admin/'.$res->id) }}" class="btn btn-sm btn-light" title="Edit"><i class="ti ti-edit"></i></a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center py-4 text-muted">No resellers registered yet.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>


  {{-- ====================================================================
       2. ADMIN (RESELLER / DISTRIBUTOR) DASHBOARD
       ==================================================================== --}}
  @elseif (Auth::user()->type == 'admin')

    <!-- KPI Row -->
    <div class="row g-3 mb-4">
      <div class="col-sm-6 col-xl-3">
        <div class="card border-0 h-100" style="border-radius: 18px; background: #ffffff; border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04);">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <span style="font-size: 0.85rem; font-weight: 700; color: #64748b;">Total Stores / Users</span>
              <div style="width: 44px; height: 44px; border-radius: 12px; background: #fff1f2; display: flex; align-items: center; justify-content: center; color: #e11d48; font-size: 1.3rem;">
                <i class="ti ti-users"></i>
              </div>
            </div>
            <div class="d-flex align-items-baseline justify-content-between">
              <h2 class="mb-0 fw-bold" style="color: #0f172a; font-size: 1.9rem;">{{ $Users }}</h2>
              <span class="badge rounded-pill" style="background: #f1f5f9; color: #475569; font-weight: 700; font-size: 0.72rem;">Clients</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-xl-3">
        <div class="card border-0 h-100" style="border-radius: 18px; background: #ffffff; border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04);">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <span style="font-size: 0.85rem; font-weight: 700; color: #64748b;">Active Subscriptions</span>
              <div style="width: 44px; height: 44px; border-radius: 12px; background: #f0fdf4; display: flex; align-items: center; justify-content: center; color: #16a34a; font-size: 1.3rem;">
                <i class="ti ti-user-check"></i>
              </div>
            </div>
            <div class="d-flex align-items-baseline justify-content-between">
              <h2 class="mb-0 fw-bold" style="color: #16a34a; font-size: 1.9rem;">{{ $ActiveUsers }}</h2>
              <span class="badge rounded-pill" style="background: #dcfce7; color: #15803d; font-weight: 700; font-size: 0.72rem;">Running</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-xl-3">
        <div class="card border-0 h-100" style="border-radius: 18px; background: #ffffff; border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04);">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <span style="font-size: 0.85rem; font-weight: 700; color: #64748b;">Inactive Stores</span>
              <div style="width: 44px; height: 44px; border-radius: 12px; background: #fffbeb; display: flex; align-items: center; justify-content: center; color: #d97706; font-size: 1.3rem;">
                <i class="ti ti-user-x"></i>
              </div>
            </div>
            <div class="d-flex align-items-baseline justify-content-between">
              <h2 class="mb-0 fw-bold" style="color: #d97706; font-size: 1.9rem;">{{ $InactiveUsers }}</h2>
              <span class="badge rounded-pill" style="background: #fef3c7; color: #b45309; font-weight: 700; font-size: 0.72rem;">Inactive</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-xl-3">
        <div class="card border-0 h-100" style="border-radius: 18px; background: #ffffff; border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04);">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <span style="font-size: 0.85rem; font-weight: 700; color: #64748b;">Credit Balance</span>
              <div style="width: 44px; height: 44px; border-radius: 12px; background: #fef2f2; display: flex; align-items: center; justify-content: center; color: #ef4444; font-size: 1.3rem;">
                <i class="ti ti-wallet"></i>
              </div>
            </div>
            <div class="d-flex align-items-baseline justify-content-between">
              <h2 class="mb-0 fw-bold" style="color: #e11d48; font-size: 1.9rem;">{{ Auth::user()->user_create_limit }}</h2>
              <span class="badge rounded-pill" style="background: #fee2e2; color: #b91c1c; font-weight: 700; font-size: 0.72rem;">Available</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Reseller Referral & Action Widget -->
    <div class="row g-3 mb-4">
      <div class="col-lg-8">
        <div class="card border-0 h-100" style="border-radius: 20px; border: 1px solid #e2e8f0 !important; background: #ffffff;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <h5 class="fw-bold mb-0" style="color: #0f172a;"><i class="ti ti-link me-2 text-primary"></i>Your Direct Client Signup URL</h5>
              <span class="badge" style="background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; font-weight: 700;">Affiliate Active</span>
            </div>
            <p class="text-muted" style="font-size: 0.85rem;">Share this signup link with your clients to automatically attribute new signups to your reseller account.</p>

            <div class="input-group mb-2">
              <input type="text" id="resellerSignupUrl" class="form-control" value="{{ url('site/'.Auth::user()->name_url) }}" readonly style="height: 48px; border-radius: 12px 0 0 12px; background: #f8fafc; font-weight: 600; font-size: 0.9rem;" />
              <button class="btn" type="button" onclick="navigator.clipboard.writeText(document.getElementById('resellerSignupUrl').value); toastr.success('Signup link copied!');" style="background: #0f172a; color: #fff; font-weight: 700; border-radius: 0 12px 12px 0; padding: 0 22px;">
                <i class="ti ti-copy me-1"></i> Copy Link
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card border-0 h-100" style="border-radius: 20px; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff;">
          <div class="card-body p-4 d-flex flex-column justify-content-between">
            <div>
              <span class="badge mb-2" style="background: rgba(225,29,72,0.25); color: #fda4af; font-weight: 700; padding: 4px 10px; border-radius: 6px;">Wallet Quota</span>
              <h3 class="fw-bold text-white mb-1">{{ Auth::user()->user_create_limit }} Accounts</h3>
              <p style="color: #94a3b8; font-size: 0.82rem;">Available user creation credits in your distributor wallet.</p>
            </div>
            <a href="{{ url('admin/my_wallets_list') }}" class="btn btn-sm w-100" style="background: #e11d48; color: #fff; font-weight: 700; border-radius: 10px; height: 40px; display: flex; align-items: center; justify-content: center; gap: 6px;">
              <span>View Wallet History</span>
              <i class="ti ti-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Users Table -->
    <div class="card border-0 mb-4" style="border-radius: 20px; border: 1px solid #e2e8f0 !important;">
      <div class="card-header bg-white d-flex align-items-center justify-content-between p-4" style="border-bottom: 1px solid #f1f5f9; border-radius: 20px 20px 0 0;">
        <h5 class="mb-0 fw-bold" style="color: #0f172a;"><i class="ti ti-users me-2 text-primary"></i>Recently Registered Stores</h5>
        <a href="{{ url('admin/sub_user_list') }}" class="btn btn-sm btn-outline-primary" style="border-radius: 10px; font-weight: 700;">View All Users</a>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
            <thead class="table-light">
              <tr>
                <th class="ps-4">User / Store Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Expiry</th>
                <th class="pe-4 text-end">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($recent_users as $u)
                <tr>
                  <td class="ps-4 fw-bold text-dark">{{ $u->name }}</td>
                  <td>{{ $u->email }}</td>
                  <td>{{ $u->phone ?? '-' }}</td>
                  <td>
                    @if($u->status == 'active')
                      <span class="badge bg-success-subtle text-success fw-bold">Active</span>
                    @else
                      <span class="badge bg-danger-subtle text-danger fw-bold">Inactive</span>
                    @endif
                  </td>
                  <td>{{ date('d M Y', strtotime($u->expiry_date)) }}</td>
                  <td class="pe-4 text-end">
                    <a href="{{ url('admin/edit_user/'.$u->id) }}" class="btn btn-sm btn-light" title="Edit"><i class="ti ti-edit"></i></a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center py-4 text-muted">No users registered under your account yet.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>


  {{-- ====================================================================
       3. USER (BUSINESS / STORE OWNER) DASHBOARD
       ==================================================================== --}}
  @else

    <!-- KPI Row: 5 Cards with rich gradients and micro details -->
    <div class="row g-3 mb-4">
      
      <!-- 1. Feedback Questions -->
      <div class="col-sm-6 col-xl-4 col-xxl">
        <div class="card border-0 h-100" style="border-radius: 18px; background: #ffffff; border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04); transition: transform 0.2s ease;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <span style="font-size: 0.85rem; font-weight: 700; color: #64748b;">Feedback Forms</span>
              <div style="width: 44px; height: 44px; border-radius: 12px; background: #fff1f2; display: flex; align-items: center; justify-content: center; color: #e11d48; font-size: 1.3rem;">
                <i class="ti ti-forms"></i>
              </div>
            </div>
            <div class="d-flex align-items-baseline justify-content-between">
              <h2 class="mb-0 fw-bold" style="color: #0f172a; font-size: 1.9rem;">{{ $Question }}</h2>
              <a href="{{ url('admin/questions') }}" class="btn btn-xs d-flex align-items-center gap-1" style="background: #fff1f2; color: #e11d48; border-radius: 8px; font-weight: 700; font-size: 0.75rem; padding: 4px 10px; text-decoration: none;">
                <span>Manage</span>
                <i class="ti ti-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- 2. Reviews Collected -->
      <div class="col-sm-6 col-xl-4 col-xxl">
        <div class="card border-0 h-100" style="border-radius: 18px; background: #ffffff; border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04); transition: transform 0.2s ease;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <span style="font-size: 0.85rem; font-weight: 700; color: #64748b;">Reviews Collected</span>
              <div style="width: 44px; height: 44px; border-radius: 12px; background: #eff6ff; display: flex; align-items: center; justify-content: center; color: #2563eb; font-size: 1.3rem;">
                <i class="ti ti-stars"></i>
              </div>
            </div>
            <div class="d-flex align-items-baseline justify-content-between">
              <h2 class="mb-0 fw-bold" style="color: #2563eb; font-size: 1.9rem;">{{ $feedback_form_submit }}</h2>
              <a href="{{ url('admin/list_question_answers') }}" class="btn btn-xs d-flex align-items-center gap-1" style="background: #eff6ff; color: #2563eb; border-radius: 8px; font-weight: 700; font-size: 0.75rem; padding: 4px 10px; text-decoration: none;">
                <span>View</span>
                <i class="ti ti-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- 3. Private Leads -->
      <div class="col-sm-6 col-xl-4 col-xxl">
        <div class="card border-0 h-100" style="border-radius: 18px; background: #ffffff; border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04); transition: transform 0.2s ease;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <span style="font-size: 0.85rem; font-weight: 700; color: #64748b;">Private Leads</span>
              <div style="width: 44px; height: 44px; border-radius: 12px; background: #fef2f2; display: flex; align-items: center; justify-content: center; color: #ef4444; font-size: 1.3rem;">
                <i class="ti ti-shield-lock"></i>
              </div>
            </div>
            <div class="d-flex align-items-baseline justify-content-between">
              <h2 class="mb-0 fw-bold" style="color: #ef4444; font-size: 1.9rem;">{{ $privateReview }}</h2>
              <a href="{{ url('admin/private_review_list') }}" class="btn btn-xs d-flex align-items-center gap-1" style="background: #fef2f2; color: #ef4444; border-radius: 8px; font-weight: 700; font-size: 0.75rem; padding: 4px 10px; text-decoration: none;">
                <span>Inquiries</span>
                <i class="ti ti-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- 4. WhatsApp Messages -->
      <div class="col-sm-6 col-xl-6 col-xxl">
        <div class="card border-0 h-100" style="border-radius: 18px; background: #ffffff; border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04); transition: transform 0.2s ease;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <span style="font-size: 0.85rem; font-weight: 700; color: #64748b;">WhatsApp Sent</span>
              <div style="width: 44px; height: 44px; border-radius: 12px; background: #ecfdf5; display: flex; align-items: center; justify-content: center; color: #059669; font-size: 1.3rem;">
                <i class="ti ti-brand-whatsapp"></i>
              </div>
            </div>
            <div class="d-flex align-items-baseline justify-content-between">
              <h2 class="mb-0 fw-bold" style="color: #059669; font-size: 1.9rem;">{{ Auth::user()->wp_count ?? 0 }}</h2>
              <span class="badge rounded-pill" style="background: #d1fae5; color: #065f46; font-weight: 700; font-size: 0.72rem;">Sent</span>
            </div>
          </div>
        </div>
      </div>

      <!-- 5. Video Reviews -->
      <div class="col-sm-6 col-xl-6 col-xxl">
        <div class="card border-0 h-100" style="border-radius: 18px; background: #ffffff; border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04); transition: transform 0.2s ease;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <span style="font-size: 0.85rem; font-weight: 700; color: #64748b;">Video Reviews</span>
              <div style="width: 44px; height: 44px; border-radius: 12px; background: #f5f3ff; display: flex; align-items: center; justify-content: center; color: #7c3aed; font-size: 1.3rem;">
                <i class="ti ti-video"></i>
              </div>
            </div>
            <div class="d-flex align-items-baseline justify-content-between">
              <h2 class="mb-0 fw-bold" style="color: #7c3aed; font-size: 1.9rem;">{{ $video_testimonial }}</h2>
              <a href="{{ url('admin/video_testimonial') }}" class="btn btn-xs d-flex align-items-center gap-1" style="background: #f5f3ff; color: #7c3aed; border-radius: 8px; font-weight: 700; font-size: 0.75rem; padding: 4px 10px; text-decoration: none;">
                <span>Watch</span>
                <i class="ti ti-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Main Store Widgets Row -->
    <div class="row g-3 mb-4">
      
      <!-- Review Page URL & Quick Share Box -->
      <div class="col-lg-7">
        <div class="card border-0 h-100" style="border-radius: 20px; border: 1px solid #e2e8f0 !important; background: #ffffff; box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04);">
          <div class="card-body p-4 d-flex flex-column justify-content-between">
            <div>
              <div class="d-flex align-items-center justify-content-between mb-2">
                <h5 class="fw-bold mb-0" style="color: #0f172a;">
                  <i class="ti ti-world me-2 text-primary"></i>Your Store Review Portal
                </h5>
                <span class="badge d-inline-flex align-items-center gap-1.5" style="background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; font-weight: 700; padding: 5px 10px; border-radius: 8px;">
                  <span class="d-inline-block rounded-circle" style="width: 6px; height: 6px; background: #16a34a;"></span>
                  <span>Live &amp; Active</span>
                </span>
              </div>
              <p class="text-muted mb-3" style="font-size: 0.88rem;">
                When customers scan your QR stand or visit this portal, high ratings (4-5★) go straight to your Google profile, while constructive feedback stays private.
              </p>

              <!-- Link Copy Bar -->
              <div class="input-group mb-3">
                <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px; color: #94a3b8; border-color: #cbd5e1;">
                  <i class="ti ti-link"></i>
                </span>
                <input 
                  type="text" 
                  id="userReviewPortalUrl" 
                  class="form-control border-start-0 ps-0" 
                  value="{{ url('u/'.Auth::user()->name_url) }}" 
                  readonly 
                  style="height: 48px; background: #ffffff; font-weight: 600; font-size: 0.9rem; color: #0f172a; border-color: #cbd5e1;"
                />
                <button 
                  class="btn" 
                  type="button" 
                  onclick="navigator.clipboard.writeText(document.getElementById('userReviewPortalUrl').value); toastr.success('Review Portal link copied!');" 
                  style="background: #0f172a; color: #ffffff; font-weight: 700; border-radius: 0 12px 12px 0; padding: 0 22px; transition: background 0.2s ease;"
                  onmouseover="this.style.background='#e11d48'"
                  onmouseout="this.style.background='#0f172a'"
                >
                  <i class="ti ti-copy me-1"></i> Copy Link
                </button>
              </div>
            </div>

            <!-- Features Pill List -->
            <div class="d-flex align-items-center gap-2 flex-wrap pt-3 border-top">
              <a href="{{ url('u/'.Auth::user()->name_url) }}" target="_blank" class="btn btn-sm btn-outline-dark d-flex align-items-center gap-1.5" style="border-radius: 10px; font-weight: 700; padding: 6px 14px;">
                <i class="ti ti-external-link"></i> Preview Portal
              </a>
              <a href="{{ url('admin/view_qr') }}" class="btn btn-sm d-flex align-items-center gap-1.5" style="background: #fff1f2; color: #e11d48; border: 1px solid #fecdd3; border-radius: 10px; font-weight: 700; padding: 6px 14px;">
                <i class="ti ti-qrcode"></i> QR Stand Design
              </a>
              <a href="{{ url('admin/review_links') }}" class="btn btn-sm btn-light d-flex align-items-center gap-1.5" style="border-radius: 10px; font-weight: 700; color: #475569; padding: 6px 14px;">
                <i class="ti ti-plug"></i> Google Reviews Link
              </a>
            </div>

          </div>
        </div>
      </div>

      <!-- Plan & Subscription Status Card -->
      <div class="col-lg-5">
        <div class="card border-0 h-100" style="border-radius: 20px; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff; box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.1);">
          <div class="card-body p-4 d-flex flex-column justify-content-between">
            <div>
              <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="badge" style="background: rgba(225,29,72,0.25); color: #fda4af; font-weight: 700; padding: 6px 12px; border-radius: 8px;">
                  <i class="ti ti-sparkles me-1"></i>
                  @if(Auth::user()->seven_day_trial == 'YES') 7-Day Trial @else Active Subscription @endif
                </span>
                <span style="font-size: 0.8rem; color: #94a3b8;">
                  Expires: {{ date('d M Y', strtotime(Auth::user()->expiry_date)) }}
                </span>
              </div>

              @php
                $expiry_date = Auth::user()->expiry_date;
                $expiry_timestamp = strtotime($expiry_date);
                $difference = $expiry_timestamp - time();
                $days_difference = max(0, floor($difference / (60 * 60 * 24)));
              @endphp

              <h2 class="fw-bold text-white mb-2" style="font-size: 2rem;">{{ $days_difference }} Days Remaining</h2>
              <p style="color: #94a3b8; font-size: 0.86rem; line-height: 1.5;">
                Keep your review booster running 24/7, shield against negative ratings, and generate unlimited QR stand prints.
              </p>
            </div>

            <div class="pt-3">
              <button 
                onclick="get_plans()" 
                type="button" 
                class="btn w-100 d-flex align-items-center justify-content-center gap-2" 
                style="background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); color: #ffffff; font-weight: 700; border-radius: 12px; height: 46px; border: none; box-shadow: 0 6px 18px rgba(225,29,72,0.35); transition: transform 0.2s ease;"
              >
                <i class="ti ti-crown"></i>
                <span>Upgrade / Renew Plan</span>
                <i class="ti ti-arrow-right ms-auto"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Recent Feedback Data Table -->
    <div class="card border-0 mb-4" style="border-radius: 20px; border: 1px solid #e2e8f0 !important; background: #ffffff; box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04);">
      <div class="card-header bg-white d-flex align-items-center justify-content-between p-4" style="border-bottom: 1px solid #f1f5f9; border-radius: 20px 20px 0 0;">
        <div class="d-flex align-items-center gap-2">
          <div style="width: 36px; height: 36px; border-radius: 10px; background: #fff1f2; display: flex; align-items: center; justify-content: center; color: #e11d48;">
            <i class="ti ti-message-2-check fs-5"></i>
          </div>
          <div>
            <h5 class="mb-0 fw-bold" style="color: #0f172a;">Recent Feedback Submissions</h5>
            <small class="text-muted">Latest feedback and rating submissions from your customers</small>
          </div>
        </div>
        <a href="{{ url('admin/list_question_answers') }}" class="btn btn-sm btn-outline-primary" style="border-radius: 10px; font-weight: 700; padding: 6px 16px;">View All Feedback</a>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
            <thead class="table-light">
              <tr>
                <th class="ps-4">Submission</th>
                <th>Customer Name</th>
                <th>Contact Phone</th>
                <th>Submitted Date</th>
                <th class="pe-4 text-end">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($recent_feedbacks as $fb)
                <tr>
                  <td class="ps-4">
                    <span class="badge rounded-pill" style="background: #f1f5f9; color: #475569; font-weight: 700;">#{{ $fb->id }}</span>
                  </td>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <div style="width: 32px; height: 32px; border-radius: 50%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #475569; font-size: 0.8rem;">
                        {{ strtoupper(substr($fb->name ?? 'A', 0, 1)) }}
                      </div>
                      <span class="fw-bold text-dark">{{ $fb->name ?? 'Anonymous Customer' }}</span>
                    </div>
                  </td>
                  <td>
                    @if($fb->phone)
                      <a href="tel:{{ $fb->phone }}" class="text-muted text-decoration-none"><i class="ti ti-phone me-1"></i>{{ $fb->phone }}</a>
                    @else
                      <span class="text-muted">-</span>
                    @endif
                  </td>
                  <td>
                    <span style="color: #64748b;"><i class="ti ti-calendar-time me-1"></i>{{ date('d M Y, h:i A', strtotime($fb->created_at)) }}</span>
                  </td>
                  <td class="pe-4 text-end">
                    <a href="{{ url('admin/view_question_answers/'.$fb->id) }}" class="btn btn-sm btn-light" title="View Details" style="border-radius: 8px;">
                      <i class="ti ti-eye"></i>
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center py-5">
                    <div style="width: 56px; height: 56px; border-radius: 50%; background: #f8fafc; border: 1px solid #e2e8f0; display: inline-flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 1.5rem; margin-bottom: 12px;">
                      <i class="ti ti-inbox"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">No Customer Feedback Yet</h6>
                    <p class="text-muted mb-3" style="max-width: 420px; margin: 0 auto; font-size: 0.85rem;">
                      Your reviews will appear here once customers scan your QR stand or visit your review page.
                    </p>
                    <div class="d-flex align-items-center justify-content-center gap-2">
                      <a href="{{ url('u/'.Auth::user()->name_url) }}" target="_blank" class="btn btn-sm btn-outline-dark" style="border-radius: 10px; font-weight: 700;">
                        <i class="ti ti-external-link me-1"></i>Test Review Page
                      </a>
                      <a href="{{ url('admin/view_qr') }}" class="btn btn-sm d-flex align-items-center gap-1.5" style="background: #e11d48; color: #fff; border-radius: 10px; font-weight: 700;">
                        <i class="ti ti-qrcode"></i>Get QR Stand
                      </a>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

  @endif

</div>

@endsection