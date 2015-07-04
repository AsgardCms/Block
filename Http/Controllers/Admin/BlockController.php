<?php namespace Modules\Block\Http\Controllers\Admin;

use Modules\Block\Entities\Block;
use Modules\Block\Http\Requests\CreateBlockRequest;
use Modules\Block\Http\Requests\UpdateBlockRequest;
use Modules\Block\Repositories\BlockRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class BlockController extends AdminBaseController
{
    /**
     * @var BlockRepository
     */
    private $block;

    public function __construct(BlockRepository $block)
    {
        parent::__construct();

        $this->block = $block;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $blocks = $this->block->all();

        return view('block::admin.blocks.index', compact('blocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('block::admin.blocks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateBlockRequest $request
     * @return Response
     */
    public function store(CreateBlockRequest $request)
    {
        $this->block->create($request->all());

        flash(trans('block::blocks.messages.block created'));

        return redirect()->route('admin.block.block.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Block $block
     * @return Response
     */
    public function edit(Block $block)
    {
        return view('block::admin.blocks.edit', compact('block'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Block $block
     * @param  UpdateBlockRequest $request
     * @return Response
     */
    public function update(Block $block, UpdateBlockRequest $request)
    {
        $this->block->update($block, $request->all());

        flash(trans('block::blocks.messages.block updated'));

        if ($request->get('button') == 'index') {
            return redirect()->route('admin.block.block.index');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Block $block
     * @return Response
     */
    public function destroy(Block $block)
    {
        $this->block->destroy($block);

        flash(trans('block::blocks.messages.block deleted'));

        return redirect()->route('admin.block.block.index');
    }
}
