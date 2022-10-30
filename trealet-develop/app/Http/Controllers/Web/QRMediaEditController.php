<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Album;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Image;
use Vanguard\Trealets;
use Illuminate\Support\Facades\DB;
use Symfony\Component\CssSelector\Node\FunctionNode;

class QRMediaEditController extends Controller
{
    public function index()
    {
        $albums = $this->getAlbum();

        return view('trealets.my-qrmedia', compact('albums'));
    }

    public function edit($id)
    {
        $data = Trealets::findOrFail($id);
        $stepquest = json_decode($data->json, true)['trealet'];

        return view('trealets.my-stepquest-edit', compact('id', 'stepquest'));
    }

    public function update($id, Request $request)
    {
        $trealet = Trealets::findOrFail($id);
        $oldItems = json_decode($trealet->json, true)['trealet']['items'];

        $files = [];
        foreach ($request->file() as $key => $file) {
            $path = $file->storeAs(
                'upload/trealet-data',
                date('YmdHis') . $key . '.' . $file->getClientOriginalExtension(),
                ['disk' => 'public']
            );
            $files = array_merge($files, [
                [
                    'key' => $key,
                    'value' => url($path),
                ]
            ]);
        }
        $items = array_map(function ($value) use ($files, $oldItems) {
            $keyFound = array_search(
                $value['index'],
                array_column($files, 'key')
            );
            if ($keyFound !== false) {
                $value['file'] = $files[$keyFound]['value'];
            } else {
                $keyFound = array_search($value['key'], array_column($oldItems, 'key'));
                if ($keyFound !== false) {
                    if ($oldItems[$keyFound]['file']) {
                        $value['file'] = $oldItems[$keyFound]['file'];
                    }
                }
            }
            unset($value['index']);

            return $value;
        }, $request->get('items'));
        $stepQuest = [
            'trealet' => array_merge(
                $request->only('title', 'des'),
                ['items' => $items]
            )
        ];
        DB::update(
            'update au_trealets set user_id = ?, title = ?,json = ? where id = ?',
            [
                auth()->id(),
                $request->get('title', ''),
                stripslashes(json_encode($stepQuest, JSON_UNESCAPED_UNICODE)),
                $id,
            ]
        );

        return route('my-trealets');
    }

    public function getAlbum()
    {
        return Album::all()->map(function ($item) {
            $folders = explode('/', $item->folder);

            return [
                'id' => $item->id,
                'title' => str_replace('-', ' ', $folders[count($folders) - 1]),
            ];
        });
    }

    public function ungdung(Request $request)
    {
        $donvi = $request->get('donVi', 1);
        return Album::where('parentid', $donvi)
            ->get()
            ->map(function ($album) {
                $folders = explode('/', $album->folder);

                return [
                    'id' => $album->id,
                    'title' => str_replace('-', ' ', $folders[count($folders) - 1]),
                ];
            })->toJson();
    }

    public function treeFolder()
    {
        $albums = Album::all()->map(function ($album) {
            $folders = explode('/', $album->folder);

            return [
                'id' => $album->id,
                'path' => str_replace('-', ' ', $folders[count($folders) - 1]),
                'folder' => [],
                'parentid' => $album->parentid ?? null
            ];
        })->toArray();

        echo json_encode($this->parseTree($albums, $albums[0]));
    }

    private function parseTree($tree, $root = null)
    {
        $return = [];
        foreach ($tree as $child => $parent) {
            if ($parent['parentid'] == $root['id']) {
                unset($tree[$child]);
                $return[] = array(
                    'id' => $parent['id'],
                    'text' => '<span class="parentId" data-id= ' . $parent['id'] . '>' . $parent['path'] . '</span>',
                    'nodes' => $this->parseTree($tree, $parent)
                );
            } else {
                $return[] = array(
                    'id' => $parent['id'],
                    'text' => '<span class="parentId" data-id= ' . $parent['id'] . '>' . $parent['path'] . '</span>',
                    'nodes' => []
                );
            }
        }
        return empty($return) ? null : $return;
    }

    public function image(Request $request)
    {
        $donvi = $request->get('donVi', 1);

        return Image::where('albumid', $donvi)->get()->map(function ($image) {
            return [
                'id' => $image->id,
                'title' => $image->filename,
            ];
        })->toJson();
    }

    public function upload(Request $request)
    {
        $files = [];
        foreach ($request->file() as $key => $file) {
            $path = $file->storeAs(
                'upload/trealet-data',
                date('YmdHis') . $key . '.' . $file->getClientOriginalExtension(),
                ['disk' => 'public']
            );
            $files = array_merge($files, [
                [
                    'key' => $key,
                    'value' => url($path),
                ]
            ]);
        }
        $items = array_map(function ($value) use ($files) {
            $keyFound = array_search(
                $value['index'],
                array_column($files, 'key')
            );
            if ($keyFound !== false) {
                $value['file'] = $files[$keyFound]['value'];
            }
            unset($value['index']);

            return $value;
        }, $request->get('items'));

        $stepQuest = ['trealet' => array_merge($request->only('title', 'des', 'minScore', 'gift'), ['items' => $items])];
        DB::insert(
            'insert into au_trealets(id_str, user_id, title, type, json) value(UUID_SHORT(), ?, ?, ?, ?)',
            [
                auth()->id(),
                $request->get('title', ''),
                Trealets::STEPQUEST_TYPE,
                stripslashes(json_encode($stepQuest, JSON_UNESCAPED_UNICODE)),
            ]
        );

        return route('my-trealets');
    }
}