<?php

namespace App\Http\Controllers\ToolsCont;

use App\Http\Controllers\Controller;
use App\Models\FlashcardsCard;
use App\Models\FlashcardsCategory;
use App\Models\FlashcardsSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class FlashcardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $loggedInUser = Auth::user();

        $userFc = FlashcardsSet::select('fcs.id', 'fcs.name', 'fcs.description', 'fcc.category', 'fcc.color')
                                ->from('flashcards_sets as fcs')
                                ->where('fcs.user_id', $loggedInUser->id)
                                ->join('flashcards_categories as fcc', 'fcs.category_id', '=', 'fcc.id')->get();

        $userFcCategory = FlashcardsCategory::where('user_id', $loggedInUser->id)->get();

        return view('fc_views.flashcards', 
        [
            'fcCategory' => $userFcCategory,
            'flashcards' => $userFc
        ]);
    }

    public function show(FlashcardsSet $flashcard)
    {
        if (Auth::user()->id !== $flashcard->user_id) {
            abort(403);
        }

        $category = FlashcardsCategory::select('color')
                                        ->where('id', $flashcard->category_id)->get()->first();
        
        $cardInSet = FlashcardsCard::where('set_id', $flashcard->id)->get();
        
        return view('fc_views.flashcards_card',
        [
            'flashcard' => $flashcard,
            'category' => $category,
            'cards' => $cardInSet,
        ]);
    }

    public function addSetSubmit(Request $request)
    {
        $flashcards_set = new FlashcardsSet();

        $validatedData = $request->validate([
            'setName' => [
                'required',
                'max:16',
                'regex:/^[a-zA-Z0-9\s]*$/', // Letters and numbers only
                Rule::unique('flashcards_sets', 'name')
                    ->where(function($query) use ($request) {
                        $query->where('user_id', Auth::id())
                                ->whereRaw('lower(name) = lower(?)', $request->setName);
                        
                        if(!empty($request->setCat)) {
                            $query->where('category_id', $request->setCat);
                        }
                        
                        return $query;
                    })
            ],
            'setDesc' => 'nullable|max:50|regex:/^[a-zA-Z0-9\s]*$/', // Letters and numbers only
            'setCat' => 'required'
        ], [
            'setName.required' => 'Name field should not be empty!',
            'setName.regex' => 'Only letters and numbers allowed',
            'setName.unique' => 'Set already exist!',

            'setDesc.regex' => 'Desc Only letters and numbers allowed',
            'setCat.required' => 'Please select a category!',
        ]);

        $flashcards_set->name = $validatedData['setName'];
        $flashcards_set->description = empty($validatedData['setDesc']) ? '' : $validatedData['setDesc'];
        $flashcards_set->category_id = $validatedData['setCat'];
        $flashcards_set->user_id = Auth::id();

        $flashcards_set->save();
        $flashcards_set->refresh();

        $relatedCategory = FlashcardsCategory::where('id', $validatedData['setCat'])->first();

        return response()->json([
            'success' => true,
            'set' => $flashcards_set,
            'category' => $relatedCategory
        ]);

    }

    public function addCategorySubmit(Request $request)
    {
        $flashcards_category = new FlashcardsCategory();

        $validatedData = $request->validate([
            'categoryName' => [
                'required',
                'max:16',
                'regex:/^[a-zA-Z0-9\s]*$/', // Letters and numbers only
                Rule::unique('flashcards_categories', 'category')
                    ->where(function($query) use ($request) {
                        return $query->where('user_id', Auth::id())
                            ->whereRaw('lower(category) = lower(?)', $request->categoryName);
                    })
            ],
            'categoryColor' => 'required|max:7',
        ], [
            'categoryName.required' => 'Category field should not be empty!',
            'categoryName.unique' => 'This category name already exists!',
        ]);
        
        $flashcards_category->category = $validatedData['categoryName'];
        $flashcards_category->color = $validatedData['categoryColor'];
        $flashcards_category->user_id = Auth::id();

        $flashcards_category->save();
        $flashcards_category->refresh();

        return response()->json([
            'success' => true,
            'category' => $flashcards_category
        ]);
    }

    public function addCardSubmit(Request $request)
    {
        $flashcards_card = new FlashcardsCard();

        $validatedData = $request->validate([
            'setTerm' => 'required|max:255',
            'setDefinition' => 'required|max:255',
            'setSetId' => 'required',
            'setCardColor' => 'required'
        ]);

        $flashcards_card->term = $validatedData['setTerm'];
        $flashcards_card->definition = $validatedData['setDefinition'];
        $flashcards_card->set_id = $validatedData['setSetId'];

        $flashcards_card->save();
        $flashcards_card->refresh();

        return response()->json([
            'success' => true,
            'card' => $flashcards_card,
            'catColor' => $validatedData['setCardColor']
        ]);
    }

    public function deleteCategorySubmit(Request $request){
        $idsToDelete = $request->input('deleteId');

        foreach($idsToDelete as $id){
            $model = FlashcardsCategory::find($id);
            $model->delete();
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function review()
    {
        $flashcardSetId = request('fc');
        
        $eachCards = FlashcardsCard::where('set_id', $flashcardSetId)->get();

        return view('fc_views.flashcards_review', ['eachCards' => $eachCards]);
    }
}
