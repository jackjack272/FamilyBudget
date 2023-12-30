<table>
    <tr>
                 
        <?php
            use Illuminate\Support\Facades\Db;
            use Illuminate\Support\Facades\Auth;

            if(Auth::id() !=null){
            // see if admin 
            $is_admin=Db::table('users')
                ->where('id',Auth::id())
                ->select('is_admin')
                ->get();
            if($is_admin[0]->is_admin == 1){
                ?>
                    <td>
                        <a href="{{route('admin.all_users') }}">
                            <button  class="button button-primary">
                                Admin pannel
                            </button>

                        </a>
                    </td>
                <?php
            }// theyll never know shhhh heheheh
        }
        ?>
    @auth
            <form id="logout" action="{{ route('logout') }}" method="POST">
            <td>
                <a onclick="document.getElementById('logout').submit();">
                    <button  class="button button-primary">
                        Logout
                    </button>
                </a>
                @csrf
                </form>

            </td> 
        </tr>

        <tr>
            <td>
                <a href="{{route('budget.show') }}">
                    <button  class="button button-primary">
                        people in budget
                    </button>
                </a>
            </td>

            
            <td>
                <a  href="{{route('api.call') }}">
                    <button  class="button button-primary">
                        API
                    </button>
                </a>
            </td>

            <td>
                <a href="{{route('budget.totals')}}">
                    <button  class="button button-primary">
                        see budget
                    </button>
                </a>
            </td>
        </tr>
    @endauth


    @guest
    <tr>
        <td>
            <label for="">log in </label>
            <a href="{{route('login')}}">
                        <button>I already belong </button>

            </a>
        </td>
        <td>
            <label for="">register</label>
            <a href="{{route('register')}}">
                <button>
                    show me your way
                </button>
            </a>
        </td>
    </tr>
    <tr>

        <td>
            <a href="{{route('welcome')}}">
                <button>
                    budgeting works
                </button>
            </a>
        </td>

        <td>
            <a href="{{route('savings')}}">
                <button>
                    saving works
                </button>
            </a>
        </td>

        <td>
            <a href="{{route('trueNorth')}}">
                <button>
                    have a true north
                </button>
            </a>
        </td>

    </tr>
    @endguest
        
    </tr>
</table>