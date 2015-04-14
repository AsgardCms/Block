<?php namespace Modules\Block\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
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
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->block->create($request->all());

        Flash::success(trans('block::blocks.messages.block created'));

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
     * @param  Request $request
     * @return Response
     */
    public function update(Block $block, Request $request)
    {
        $this->block->update($block, $request->all());

        Flash::success(trans('block::blocks.messages.block updated'));

        return redirect()->route('admin.block.block.index');
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

        Flash::success(trans('block::blocks.messages.block deleted'));

        return redirect()->route('admin.block.block.index');
    }
}
