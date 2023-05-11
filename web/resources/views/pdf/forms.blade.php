<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Rekam Medis Rawat Jalan | {{ config('app.name', 'Laravel') }}</title>
  <link rel="stylesheet" href="{{ public_path('/css/app.css') }}" />
</head>

<body>
  <header class="block w-full h-auto relative">
    <div class="block w-full h-auto p-2 m-0 relative">
      <div class="block overflow-hidden relative">
        <div class="block w-32 h-auto p-0 m-0 absolute top-0 left-0 right-auto z-10">
          <div class="block w-auto h-auto p-0 m-3 text-center">
            <img 
              class="block w-auto h-[100px] ml-auto mr-auto max-w-full align-middle" 
              src="{{ public_path('/img/logo-bengkalis.png') }}" 
              height="100" 
              alt="logo-bengkalis" 
            />
          </div>
        </div>

        <div class="block w-full h-auto p-0 m-0">
          <div class="block w-full h-auto text-center">
            <span class="block w-full h-auto p-0 m-0 font-Verdana font-bold text-black text-center uppercase text-base leading-5">Pemerintah Kabupaten Bengkalis</span>
            <h5 class="block w-full h-auto p-0 m-0 font-Verdana font-bold text-black text-center uppercase text-xl leading-6">Dinas Kesehatan <br /> UPT. Puskesmas Tenggayun <br /> Kecamatan Bandar Laksamana</h5>
            <span class="block w-full h-auto p-0 m-0 font-Verdana font-normal text-black text-center text-sm leading-4">Jl. Puskesmas Tenggayun Kode Pos 28761 <br /> Email: <a href="" class="text-blue-500 underline">ptenggayun@gmail.com</a></span>
          </div>
        </div>

        <div class="block w-32 h-auto p-0 m-0 absolute top-0 left-auto right-0 z-10">
          <div class="block w-auto h-auto p-0 m-3 text-center">
            <img 
              class="block w-auto h-[100px] ml-auto mr-auto max-w-full align-middle" 
              src="{{ public_path('/img/logo-clinics.png') }}" 
              height="100" 
              alt="logo-bengkalis" 
            />
          </div>
        </div>
      </div>
      <div class="block w-full h-auto p-0 m-0 mt-2">
        <hr class="border border-black border-solid border-t m-0" />
        <hr class="border border-black border-solid border-t-[3px] m-0 mt-0.5" />
      </div>
    </div>
  </header>
  <main class="block w-full h-auto p-0 m-0">
    <div class="block w-full h-auto px-2 py-4 m-0 relative">
      <div class="block w-full h-auto p-0 m-0 after:table after:clear-both">
        <div class="block float-right w-auto h-auto p-0 m-0">
          <table class="table-fixed table w-60 h-auto p-0 m-0 border-collapse border-spacing-0">
            <tbody class="table-row-group">
              <tr class="table-row w-full h-6 p-0 m-0 align-middle text-inherit bg-white outline-none leading-6">
                <th class="table-cell w-auto h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-bold text-black text-left select-auto truncate relative">
                  Nomor RM
                </th>
                <td class="table-cellw-auto h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-normal text-black text-left select-auto truncate relative">
                  
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="block w-full h-auto px-2 py-4 m-0 relative">
      <div class="block w-full h-auto p-0 m-0">
        <h6 class="block w-full h-auto p-0 m-0 font-Verdana font-bold text-black text-center uppercase text-lg leading-10">
          Rekam Medis Rawat Jalan
        </h6>
        <hr class="border border-t-2 border-black" />
      </div>
    </div>

    <div class="block w-full h-auto px-2 py-4 m-0 relative">
      <div class="block w-full h-auto p-0 m-0 overflow-auto">
        <div class="block float-left w-2/4 h-auto p-0 pr-6 m-0">
          <table class="table-fixed table w-full h-auto p-0 m-0 border-collapse border-spacing-0">
            <tbody class="table-row-group">
              <tr class="table-row w-full h-6 p-0 m-0 align-middle text-inherit bg-white outline-none leading-6">
                <th class="table-cell w-36 h-auto p-0 m-0 border border-solid border-white font-Verdana body-2 font-bold text-black text-left uppercase select-none truncate relative">
                  Nama
                </th>
                <td class="table-cell w-auto h-auto p-0 m-0 border border-solid border-white font-Verdana body-2 font-normal text-black text-left select-auto truncate relative">
                  <b>:</b> {{ optional($user->patient)->name }}
                </td>
                <td class="table-cell w-14 h-auto p-0 m-0 border border-solid border-white font-Verdana body-2 font-normal text-black text-right select-auto truncate relative">
                  @if (optional($user->patient)->gender === 'Male')
                    <b>(L/<s>P</s>)</b>
                  @elseif (optional($user->patient)->gender === 'Female')
                    <b>(<s>L</s>/P)</b>
                  @else
                    <b>(L/P)</b>
                  @endif
                </td>
              </tr>
              <tr class="table-row w-full h-6 p-0 m-0 align-middle text-inherit bg-white outline-none leading-6">
                <th class="table-cell w-36 h-auto p-0 m-0 border border-solid border-white font-Verdana body-2 font-bold text-black text-left uppercase select-none truncate relative">
                  Tanggal Lahir
                </th>
                <td class="table-cell w-auto h-auto p-0 m-0 border border-solid border-white font-Verdana body-2 font-normal text-black text-left select-auto truncate relative" colspan="2">
                  <b>:</b> {{ optional($user->patient)->date_of_birth }}
                </td>
              </tr>
              <tr class="table-row w-full h-6 p-0 m-0 align-middle text-inherit bg-white outline-none leading-6">
                <th class="table-cell w-36 h-auto p-0 m-0 border border-solid border-white font-Verdana body-2 font-bold text-black text-left uppercase select-none truncate relative">
                  Alamat
                </th>
                <td class="table-cell w-auto h-auto p-0 m-0 border border-solid border-white font-Verdana body-2 font-normal text-black text-left select-auto truncate relative" colspan="2">
                  <b>:</b> {{ optional($user->patient)->address }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="block float-left w-2/4 h-auto p-0 pl-6 m-0">
          <table class="table-fixed table w-full h-auto p-0 m-0 border-collapse border-spacing-0">
            <tbody class="table-row-group">
              <tr class="table-row w-full h-6 p-0 m-0 align-middle text-inherit bg-white outline-none leading-6">
                <th class="table-cell w-28 h-auto p-0 m-0 border border-solid border-white font-Verdana body-2 font-bold text-black text-left uppercase select-none truncate relative">
                  Pasien
                </th>
                <td class="table-cell w-auto h-auto p-0 m-0 border border-solid border-white font-Verdana body-2 font-normal text-black text-left select-auto whitespace-normal relative">
                  @if (optional($user->patient)->type === 'General')
                    <b>: Umum / <s>JKN</s></b>
                  @elseif (optional($user->patient)->type === 'JKN')
                    <b>: <s>Umum / </s>JKN</b>
                  @else
                    <b>: Umum / JKN</b>
                  @endif
                </td>
              </tr>
              <tr class="table-row w-full h-6 p-0 m-0 align-middle text-inherit bg-white outline-none leading-6">
                <th class="table-cell w-28 h-auto p-0 m-0 border border-solid border-white font-Verdana body-2 font-bold text-black text-left uppercase select-auto truncate relative">
                  Alergi
                </th>
                <td class="table-cell w-auto h-auto p-0 m-0 border border-solid border-white font-Verdana body-2 font-normal text-black text-left select-auto truncate relative">
                  <b>:</b> {{ optional($user->patient)->allergy }}
                </td>
              </tr>
              <tr class="table-row w-full h-6 p-0 m-0 align-middle text-inherit bg-white outline-none leading-6">
                <th class="table-cell w-28 h-auto p-0 m-0 border border-solid border-white font-Verdana body-2 font-bold text-black text-left uppercase select-auto truncate relative">
                  Status
                </th>
                <td class="table-cell w-auto h-auto p-0 m-0 border border-solid border-white font-Verdana body-2 font-normal text-black text-left select-auto truncate relative">
                  @if (optional($user->patient)->status == 'Married')
                    <b>: Kawin / <s>Tidak Kawin</s></b>
                  @elseif (optional($user->patient)->status === 'Single')
                    <b>: <s>Kawin</s> / Tidak Kawin</b>
                  @else
                    <b>: Kawin / Tidak Kawin</b>
                  @endif
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="block w-full h-auto px-2 py-4 m-0 relative">
      <div class="block w-full h-auto p-0 m-0">
        <table class="table-fixed table w-full h-auto p-0 m-0 border-collapse border-spacing-0">
          <thead class="table-header-group">
            <tr class="table-row w-full h-auto p-0 m-0 align-middle text-inherit bg-white outline-none leading-normal">
              <th class="table-cell w-10 h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-bold text-black text-center uppercase select-none whitespace-normal relative">
                No.
              </th>
              <th class="table-cell w-32 h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-bold text-black text-center uppercase select-none whitespace-normal relative">
                Tanggal
              </th>
              <th class="table-cell w-auto h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-bold text-black text-center uppercase select-none whitespace-normal relative">
                S O A P
              </th>
              <th class="table-cell w-24 h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-bold text-black text-center uppercase select-none whitespace-normal relative">
                ICD X / <br /> ICD IX
              </th>
              <th class="table-cell w-24 h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-bold text-black text-center uppercase select-none whitespace-normal relative">
                Paraf Dokter
              </th>
            </tr>
          </thead>
          <tbody class="table-row-group">
            @forelse (optional($user)->forms as $item)
              <tr class="table-row w-full h-6 p-0 m-0 align-middle text-inherit bg-white outline-none leading-6">
                <td class="table-cell w-10 h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-normal text-black text-center select-auto whitespace-normal relative">
                  {{ $loop->iteration }}
                </td>
                <td class="table-cell w-10 h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-normal text-black text-center select-auto whitespace-normal relative">
                  {{ optional($item)->date }}
                </td>
                <td class="table-cell w-10 h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-normal text-black text-center select-auto whitespace-normal relative">
                  {{ optional($item)->soap }}
                </td>
                <td class="table-cell w-10 h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-normal text-black text-center select-auto whitespace-normal relative">
                  {{ optional($item)->icd }}
                </td>
                <td class="table-cell w-10 h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-normal text-black text-center select-auto whitespace-normal relative">
                  <img 
                    class="block w-14 h-auto ml-auto mr-auto max-w-full align-middle" 
                    src="{{ public_path("storage/{$item->doctor->signature}") }}" 
                    width="56" 
                    alt="logo-bengkalis" 
                  />
                </td>
              </tr>
            @empty
              @for ($i = 0; $i < 25; $i++)
                <tr class="w-full h-6 p-0 m-0 align-middle text-inherit bg-white outline-none leading-6">
                  <td class="table-cell w-10 h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-normal text-black text-center select-auto whitespace-normal relative"></td>
                  <td class="table-cell w-32 h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-normal text-black text-center select-auto whitespace-normal relative"></td>
                  <td class="table-cell w-auto h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-normal text-black text-left select-auto whitespace-normal relative"></td>
                  <td class="table-cell w-24 h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-normal text-black text-left select-auto whitespace-normal relative"></td>
                  <td class="table-cell w-24 h-auto p-0 m-0 border border-solid border-black font-Verdana body-2 font-normal text-black text-center select-auto whitespace-normal relative"></td>
                </tr>
              @endfor
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </main>
</body>

</html>
