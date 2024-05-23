<?php

namespace App\Controllers;

class Comments extends BaseController
{
    const COMMENT_LIMIT = 3;

    public function index()
    {
        if (!$this->request->is('post')) {
            return view('comments/index');
        }

        $response = [
            'success' => true,
            'errors' => [],
        ];
        $request = $this->request;
        $model = new \App\Models\Comments();
        $result = $model->insert([
            'email' => $request->getPost('email'),
            'content' => $request->getPost('content'),
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ]);

        if (!$result) {
            $response['success'] = false;
            $response['errors'] = $model->errors();
        }

        return $this->response->setJSON($response);
    }

    public function getComments()
    {
        $model = new \App\Models\Comments();

        return $this->response->setJSON([
            'content' => view(
                'comments/content', [
                    'comments' => $model->paginate(self::COMMENT_LIMIT),
                    'pager' => $model->pager,
                ]
            ),
        ]);
    }

    public function edit($id)
    {
        $model = new \App\Models\Comments();
        $comment = $model->find($id);
        if (!$comment) {
            show_404();;
        }

        if (!$this->request->is('post')) {
            return view('comments/edit', [
                'comment' => $comment,
                'errors' => session()->has('errors') ? session('errors') : [],
            ]);
        }

        $request = $this->request;
        $comment['email'] = $request->getPost('email');
        $comment['content'] = $request->getPost('content');
        $comment['created_at'] = $request->getPost('created_at');

        $result = $model->update($id, $comment);

        if (!$result) {
            return redirect()
                ->back()
                ->withInput($comment)
                ->with('errors', $model->errors());
        } else {
            return redirect()
                ->to('/comments')
                ->with('success', 'Комментарий обновлен')
                ->with('comment', $comment);
        }
    }
}
